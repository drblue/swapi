<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddImageSourceToResources extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach (['people', 'films', 'planets', 'species', 'starships', 'vehicles'] as $tableName) {
			Schema::table($tableName, function (Blueprint $table) use ($tableName) {
				if (!Schema::hasColumn($tableName, 'image_source')) {
					$table->string('image_source')->nullable()->after('image_url');
				}
			});
		}

		DB::table('people')
			->where(function ($query) {
				$query->where('image_url', 'like', '%wikia.nocookie.net%')
					->orWhere('image_url', 'like', '%static.wikia.nocookie.net%')
					->orWhere('image_url', 'like', '%vignette.wikia.nocookie.net%');
			})
			->whereNotNull('wiki_link')
			->update(['image_source' => DB::raw('wiki_link')]);

		$tmdbFilmSources = [
			1 => 'https://www.themoviedb.org/movie/11-star-wars',
			2 => 'https://www.themoviedb.org/movie/1891-the-empire-strikes-back',
			3 => 'https://www.themoviedb.org/movie/1892-return-of-the-jedi',
			4 => 'https://www.themoviedb.org/movie/1893-star-wars-episode-i-the-phantom-menace',
			5 => 'https://www.themoviedb.org/movie/1894-star-wars-episode-ii-attack-of-the-clones',
			6 => 'https://www.themoviedb.org/movie/1895-star-wars-episode-iii-revenge-of-the-sith',
			7 => 'https://www.themoviedb.org/movie/140607-star-wars-the-force-awakens',
			8 => 'https://www.themoviedb.org/movie/181808-star-wars-the-last-jedi',
			9 => 'https://www.themoviedb.org/movie/181812-star-wars-the-rise-of-skywalker',
		];

		foreach ($tmdbFilmSources as $id => $source) {
			DB::table('films')
				->where('id', $id)
				->where('image_url', 'like', '%themoviedb.org%')
				->update(['image_source' => $source]);
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		foreach (['people', 'films', 'planets', 'species', 'starships', 'vehicles'] as $tableName) {
			Schema::table($tableName, function (Blueprint $table) use ($tableName) {
				if (Schema::hasColumn($tableName, 'image_source')) {
					$table->dropColumn('image_source');
				}
			});
		}
	}
}
