<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ForceHttpsForWikiaLinks extends Migration
{
	private $updates = [
		'people' => ['wiki_link', 'image_source'],
		'films' => ['image_source'],
		'planets' => ['image_source'],
		'species' => ['image_source'],
		'starships' => ['image_source'],
		'vehicles' => ['image_source'],
	];

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach ($this->updates as $table => $columns) {
			foreach ($columns as $column) {
				if (!Schema::hasColumn($table, $column)) {
					continue;
				}

				DB::table($table)
					->where($column, 'like', 'http://starwars.wikia.com/%')
					->update([
						$column => DB::raw("REPLACE({$column}, 'http://starwars.wikia.com/', 'https://starwars.wikia.com/')"),
					]);
			}
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		foreach ($this->updates as $table => $columns) {
			foreach ($columns as $column) {
				if (!Schema::hasColumn($table, $column)) {
					continue;
				}

				DB::table($table)
					->where($column, 'like', 'https://starwars.wikia.com/%')
					->update([
						$column => DB::raw("REPLACE({$column}, 'https://starwars.wikia.com/', 'http://starwars.wikia.com/')"),
					]);
			}
		}
	}
}
