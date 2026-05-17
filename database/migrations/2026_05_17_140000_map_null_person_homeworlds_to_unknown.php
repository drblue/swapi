<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MapNullPersonHomeworldsToUnknown extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('people')->whereNull('homeworld_id')->update(['homeworld_id' => 28]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Keep the mapping stable; planet 28 represents unknown homeworlds.
	}
}
