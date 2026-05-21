<?php

namespace App\Console\Commands;

use App\Models\Film;
use App\Models\Person;
use App\Models\Planet;
use App\Models\Species;
use App\Models\Starship;
use App\Models\Vehicle;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class ImportExtendedMetadata extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'swapi:import-extensions
		{--dry-run : Build the normalized metadata without writing database or image files}
		{--no-images : Import text metadata without copying images}
		{--optimize : Run ImageOptim over the final copied asset tree}
		{--imagealpha : Enable ImageAlpha during optimization if ImageAlpha.app is installed}
		{--jpegmini : Enable JPEGmini during optimization if JPEGmini is installed}
		{--imageoptim=/Users/jn/.nvm/versions/node/v24.15.0/bin/imageoptim : Path to the ImageOptim CLI}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import extended Star Wars metadata from bundled extension data';

	/**
	 * Manual image overrides for cases where the strict resolution rule picks a bad outlier.
	 *
	 * Use keys like "people:1" and values relative to the project root.
	 *
	 * @var array
	 */
	private $imageOverrides = [
		// 'people:1' => 'data/oktavian/images/characters/LukeSkywalker.jpg',
	];

	/**
	 * Known source-data aliases to canonical API resource names.
	 *
	 * @var array
	 */
	private $aliases = [
		'aayla secura' => 'ayla secura',
		'bestine 4' => 'bestine iv',
		'unknown' => 'unknown',
	];

	/**
	 * Resource configuration.
	 *
	 * @var array
	 */
	private $resources = [
		'people' => [
			'class' => Person::class,
			'name_column' => 'name',
			'public_dir' => 'people',
		],
		'films' => [
			'class' => Film::class,
			'name_column' => 'title',
			'public_dir' => 'films',
		],
		'planets' => [
			'class' => Planet::class,
			'name_column' => 'name',
			'public_dir' => 'planets',
		],
		'species' => [
			'class' => Species::class,
			'name_column' => 'name',
			'public_dir' => 'species',
		],
		'starships' => [
			'class' => Starship::class,
			'name_column' => 'name',
			'public_dir' => 'starships',
		],
		'vehicles' => [
			'class' => Vehicle::class,
			'name_column' => 'name',
			'public_dir' => 'vehicles',
		],
	];

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$dryRun = (bool) $this->option('dry-run');
		$copyImages = !$this->option('no-images');

		$records = $this->emptyRecords();
		$canonical = $this->canonicalMaps();

		$this->importPrimarySource($records, $canonical);
		$this->importSecondarySource($records, $canonical);
		$this->selectImages($records, $copyImages && !$dryRun);

		if (!$dryRun) {
			$this->writeRecords($records);
		}

		$this->report($records, $dryRun);

		if ($copyImages && !$dryRun && $this->option('optimize')) {
			$this->optimizeImages();
		}

		return 0;
	}

	/**
	 * Create empty record buckets for all canonical resources.
	 */
	private function emptyRecords()
	{
		$records = [];

		foreach ($this->resources as $resource => $config) {
			$class = $config['class'];
			$nameColumn = $config['name_column'];
			$table = (new $class())->getTable();
			$columns = ['id', $nameColumn];

			if (Schema::hasColumn($table, 'image_url')) {
				$columns[] = 'image_url';
			}

			foreach (['image_source', 'short_description', 'long_description', 'force_alignment', 'lightsaber_color'] as $column) {
				if (Schema::hasColumn($table, $column)) {
					$columns[] = $column;
				}
			}

			$records[$resource] = $class::query()
				->select($columns)
				->get()
				->mapWithKeys(function (Model $model) use ($nameColumn) {
					return [$model->id => [
						'id' => $model->id,
						'name' => $model->{$nameColumn},
						'short_description' => $model->short_description ?? null,
						'long_description' => $model->long_description ?? null,
						'image_url' => $this->normalizeImageUrl($model->getRawOriginal('image_url')),
						'image_source' => $model->image_source ?? null,
						'image_candidates' => [],
						'force_alignment' => $model->force_alignment ?? null,
						'lightsaber_color' => $model->lightsaber_color ?? null,
					]];
				})
				->all();
		}

		return $records;
	}

	/**
	 * Build canonical lookup maps by normalized name/title.
	 */
	private function canonicalMaps()
	{
		$maps = [];

		foreach ($this->resources as $resource => $config) {
			$class = $config['class'];
			$nameColumn = $config['name_column'];

			$maps[$resource] = $class::query()
				->select('id', $nameColumn)
				->get()
				->mapWithKeys(function (Model $model) use ($nameColumn) {
					return [$this->normalizeName($model->{$nameColumn}) => $model->id];
				})
				->all();
		}

		return $maps;
	}

	/**
	 * Import the primary unified JSON dataset.
	 */
	private function importPrimarySource(array &$records, array $canonical)
	{
		$path = base_path('data/source-a/extras.json');

		if (!File::exists($path)) {
			$this->warn("Missing primary source data: {$path}");
			return;
		}

		$items = json_decode(File::get($path), true);

		if (!is_array($items)) {
			$this->warn("Could not parse primary source data: {$path}");
			return;
		}

		foreach ($items as $item) {
			if (empty($item['name'])) {
				continue;
			}

			$match = $this->matchByName($item['name'], $canonical);

			if (!$match) {
				$this->warn("Unmatched primary source entry: {$item['name']}");
				continue;
			}

			list($resource, $id) = $match;

			$records[$resource][$id]['short_description'] = $item['short_description'] ?? $records[$resource][$id]['short_description'];
			$records[$resource][$id]['long_description'] = $item['long_description'] ?? $records[$resource][$id]['long_description'];

			if ($resource === 'people' && !empty($item['force'])) {
				$records[$resource][$id]['force_alignment'] = $item['force'];
			}

			if (!empty($item['image'])) {
				$this->addImageCandidate($records[$resource][$id], 'source-a', base_path('data/source-a'), $item['image']);
			}
		}
	}

	/**
	 * Import the secondary split TypeScript maps.
	 */
	private function importSecondarySource(array &$records, array $canonical)
	{
		$base = base_path('data/source-b/data');

		$this->importSecondaryDescriptions($records, $canonical, 'people', $base . '/CharacterDes.ts');
		$this->importSecondaryDescriptions($records, $canonical, 'planets', $base . '/PlanetDes.ts');
		$this->importSecondaryDescriptions($records, $canonical, 'species', $base . '/speciesDescriptions.ts');
		$this->importSecondaryDescriptions($records, $canonical, 'starships', $base . '/starshipDescriptions.ts');
		$this->importSecondaryDescriptions($records, $canonical, 'vehicles', $base . '/vehicleDescriptions.ts');

		$this->importSecondaryImages($records, 'people', $base . '/PeopleImages.ts');
		$this->importSecondaryImages($records, 'planets', $base . '/PlanetImages.ts');
		$this->importSecondaryImages($records, 'species', $base . '/SpeciesImages.ts');
		$this->importSecondaryImages($records, 'starships', $base . '/StarshipImages.ts');
		$this->importSecondaryImages($records, 'vehicles', $base . '/VehicleImages.ts');

		foreach ($this->parseNumberMap($base . '/PeopleLightsaverColor.ts') as $id => $color) {
			if (isset($records['people'][$id])) {
				$records['people'][$id]['lightsaber_color'] = $color;
			}
		}
	}

	/**
	 * Import one secondary string description map.
	 */
	private function importSecondaryDescriptions(array &$records, array $canonical, $resource, $path)
	{
		foreach ($this->parseStringMap($path) as $name => $description) {
			$id = $this->matchResourceName($name, $canonical[$resource]);

			if (!$id || !isset($records[$resource][$id])) {
				$this->warn("Unmatched secondary {$resource} description: {$name}");
				continue;
			}

			if (empty($records[$resource][$id]['short_description'])) {
				$records[$resource][$id]['short_description'] = $description;
			}
		}
	}

	/**
	 * Import one secondary numeric image map.
	 */
	private function importSecondaryImages(array &$records, $resource, $path)
	{
		foreach ($this->parseNumberMap($path) as $id => $image) {
			if (!isset($records[$resource][$id])) {
				$this->warn("Unmatched secondary {$resource} image id: {$id}");
				continue;
			}

			$this->addImageCandidate($records[$resource][$id], 'source-b', base_path('data/source-b'), $image);
		}
	}

	/**
	 * Select final images and optionally copy them to public/images.
	 */
	private function selectImages(array &$records, $copyImages)
	{
		foreach ($records as $resource => &$items) {
			foreach ($items as &$record) {
				if (!empty($record['image_url'])) {
					continue;
				}

				$key = "{$resource}:{$record['id']}";
				$winner = null;

				if (isset($this->imageOverrides[$key])) {
					$overridePath = base_path($this->imageOverrides[$key]);

					if (File::exists($overridePath)) {
						$winner = $this->imageCandidate('override', $overridePath);
					} else {
						$this->warn("Missing image override for {$key}: {$overridePath}");
					}
				}

				if (!$winner) {
					$winner = $this->bestImageCandidate($record['image_candidates']);
				}

				if (!$winner) {
					continue;
				}

				$extension = strtolower(pathinfo($winner['path'], PATHINFO_EXTENSION));
				$filename = $record['id'] . '-' . $this->slug($record['name']) . '.' . $extension;
				$relativePath = 'images/' . $this->resources[$resource]['public_dir'] . '/' . $filename;
				$targetPath = public_path($relativePath);

				if ($copyImages) {
					File::ensureDirectoryExists(dirname($targetPath));
					File::copy($winner['path'], $targetPath);
				}

				$record['image_url'] = $this->localImageUrl($relativePath);
				$record['image_source'] = null;
			}
		}
	}

	/**
	 * Store local public image paths relative to the web root.
	 */
	private function normalizeImageUrl($url)
	{
		if (!$url) {
			return $url;
		}

		if (strpos($url, '/images/') === 0) {
			return $url;
		}

		$path = parse_url($url, PHP_URL_PATH);

		if ($path && strpos($path, '/images/') === 0) {
			return $path;
		}

		return $url;
	}

	/**
	 * Build a root-relative URL for an image stored under public/images.
	 */
	private function localImageUrl($relativePath)
	{
		return '/' . ltrim($relativePath, '/');
	}

	/**
	 * Persist normalized extension fields to the database.
	 */
	private function writeRecords(array $records)
	{
		foreach ($records as $resource => $items) {
			$class = $this->resources[$resource]['class'];
			$table = (new $class())->getTable();
			$hasImageSource = Schema::hasColumn($table, 'image_source');

			foreach ($items as $id => $record) {
				$values = [
					'image_url' => $record['image_url'],
					'short_description' => $record['short_description'],
					'long_description' => $record['long_description'],
				];

				if ($hasImageSource) {
					$values['image_source'] = $record['image_source'];
				}

				if ($resource === 'people') {
					$values['force_alignment'] = $record['force_alignment'];
					$values['lightsaber_color'] = $record['lightsaber_color'];
				}

				$class::query()->where('id', $id)->update($values);
			}
		}
	}

	/**
	 * Show import summary.
	 */
	private function report(array $records, $dryRun)
	{
		foreach ($records as $resource => $items) {
			$withShortDescription = count(array_filter($items, function ($record) {
				return !empty($record['short_description']);
			}));
			$withLongDescription = count(array_filter($items, function ($record) {
				return !empty($record['long_description']);
			}));
			$withImages = count(array_filter($items, function ($record) {
				return !empty($record['image_url']);
			}));

			$this->info(sprintf(
				'%s: %d records, %d short descriptions, %d long descriptions, %d images%s',
				$resource,
				count($items),
				$withShortDescription,
				$withLongDescription,
				$withImages,
				$dryRun ? ' (dry run)' : ''
			));
		}
	}

	/**
	 * Run ImageOptim on copied public assets.
	 */
	private function optimizeImages()
	{
		$imageoptim = $this->option('imageoptim');
		$assetPath = public_path('images');

		if (!is_executable($imageoptim)) {
			$this->warn("ImageOptim is not executable: {$imageoptim}");
			return;
		}

		$this->info('Running ImageOptim over final API images...');

		$options = [];
		$options[] = '--no-color';
		$options[] = '--no-stats';

		if ($this->option('imagealpha')) {
			$options[] = '--imagealpha';
		}

		if ($this->option('jpegmini')) {
			$options[] = '--jpegmini';
		}

		foreach ($this->resources as $config) {
			$directory = $assetPath . '/' . $config['public_dir'];

			if (!File::isDirectory($directory)) {
				continue;
			}

			$this->line("Optimizing {$config['public_dir']} images...");

			$command = escapeshellarg($imageoptim) . ' ' . implode(' ', $options) . ' ' . escapeshellarg($directory);
			passthru($command, $status);

			if ($status !== 0) {
				$this->warn("ImageOptim exited with status {$status} for {$config['public_dir']}");
			}
		}
	}

	/**
	 * Match a source name across all resource maps.
	 */
	private function matchByName($name, array $canonical)
	{
		foreach (['people', 'films', 'planets', 'species', 'starships', 'vehicles'] as $resource) {
			$id = $this->matchResourceName($name, $canonical[$resource]);

			if ($id) {
				return [$resource, $id];
			}
		}

		return null;
	}

	/**
	 * Match a name against one resource map.
	 */
	private function matchResourceName($name, array $map)
	{
		$normalized = $this->normalizeName($name);

		if (isset($map[$normalized])) {
			return $map[$normalized];
		}

		if (isset($this->aliases[$normalized]) && isset($map[$this->aliases[$normalized]])) {
			return $map[$this->aliases[$normalized]];
		}

		return null;
	}

	/**
	 * Add an image candidate if the referenced file exists and dimensions can be read.
	 */
	private function addImageCandidate(array &$record, $source, $basePath, $image)
	{
		$candidatePath = $basePath . $image;

		if (!File::exists($candidatePath)) {
			return;
		}

		$candidate = $this->imageCandidate($source, $candidatePath);

		if ($candidate) {
			$record['image_candidates'][] = $candidate;
		}
	}

	/**
	 * Build an image candidate with dimensions.
	 */
	private function imageCandidate($source, $path)
	{
		$size = @getimagesize($path);

		if (!$size) {
			$this->warn("Could not read image dimensions: {$path}");
			return null;
		}

		return [
			'source' => $source,
			'path' => $path,
			'width' => $size[0],
			'height' => $size[1],
			'area' => $size[0] * $size[1],
			'format_score' => $this->formatScore(pathinfo($path, PATHINFO_EXTENSION)),
		];
	}

	/**
	 * Pick the highest-resolution image candidate.
	 */
	private function bestImageCandidate(array $candidates)
	{
		if (empty($candidates)) {
			return null;
		}

		usort($candidates, function ($a, $b) {
			if ($a['area'] === $b['area']) {
				return $b['format_score'] <=> $a['format_score'];
			}

			return $b['area'] <=> $a['area'];
		});

		return $candidates[0];
	}

	/**
	 * Parse a TypeScript Record<string, string> map.
	 */
	private function parseStringMap($path)
	{
		if (!File::exists($path)) {
			$this->warn("Missing secondary map: {$path}");
			return [];
		}

		$contents = File::get($path);
		preg_match_all('/"((?:\\\\.|[^"\\\\])+)"\s*:\s*"((?:\\\\.|[^"\\\\])*)"/u', $contents, $matches, PREG_SET_ORDER);

		return collect($matches)->mapWithKeys(function ($match) {
			return [stripcslashes($match[1]) => stripcslashes($match[2])];
		})->all();
	}

	/**
	 * Parse a TypeScript Record<number, string> map.
	 */
	private function parseNumberMap($path)
	{
		if (!File::exists($path)) {
			$this->warn("Missing secondary map: {$path}");
			return [];
		}

		$contents = File::get($path);
		preg_match_all('/(\d+)\s*:\s*"((?:\\\\.|[^"\\\\])*)"/u', $contents, $matches, PREG_SET_ORDER);

		return collect($matches)->mapWithKeys(function ($match) {
			return [(int) $match[1] => stripcslashes($match[2])];
		})->all();
	}

	/**
	 * Normalize names for matching.
	 */
	private function normalizeName($name)
	{
		$name = trim(mb_strtolower($name));
		$name = str_replace(['’', '`', '´'], "'", $name);
		$name = preg_replace('/\s+/', ' ', $name);

		return $name;
	}

	/**
	 * Create a stable public filename slug.
	 */
	private function slug($value)
	{
		$slug = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);

		if ($slug === false) {
			$slug = $value;
		}

		$slug = strtolower($slug);
		$slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
		$slug = trim($slug, '-');

		return $slug ?: 'resource';
	}

	/**
	 * Rank formats for ties after resolution comparison.
	 */
	private function formatScore($extension)
	{
		$scores = [
			'avif' => 5,
			'webp' => 4,
			'png' => 3,
			'jpg' => 2,
			'jpeg' => 2,
			'gif' => 1,
		];

		$extension = strtolower($extension);

		return $scores[$extension] ?? 0;
	}
}
