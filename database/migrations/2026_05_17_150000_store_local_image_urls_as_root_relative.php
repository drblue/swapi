<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StoreLocalImageUrlsAsRootRelative extends Migration
{
	private $tables = ['films', 'people', 'planets', 'species', 'starships', 'vehicles'];

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach ($this->tables as $table) {
			if (!Schema::hasColumn($table, 'image_url')) {
				continue;
			}

			DB::table($table)
				->where('image_url', 'regexp', '^https?://[^/]+/images/')
				->select('id', 'image_url')
				->orderBy('id')
				->chunkById(100, function ($rows) use ($table) {
					foreach ($rows as $row) {
						$path = parse_url($row->image_url, PHP_URL_PATH);

						if ($path && strpos($path, '/images/') === 0) {
							DB::table($table)->where('id', $row->id)->update(['image_url' => $path]);
						}
					}
				});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Root-relative storage is intentional; APP_URL is applied at serialization time.
	}
}
