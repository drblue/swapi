<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/**
		 * Create the tables for the models.
		 */

		// People
		Schema::create('people', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('birth_year');
			$table->string('eye_color');
			$table->string('hair_color');
			$table->string('height');
			$table->string('mass');
			$table->string('skin_color');
			$table->string('created');
			$table->string('edited');

			// homeworld (1:n)
			$table->unsignedBigInteger('homeworld_id')->nullable();

			// films (n:n)
			// species (n:n)
			// starships (n:n)
			// vehicles (n:n)
		});

		// Films
		Schema::create('films', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('episode_id');
			$table->text('opening_crawl');
			$table->string('director');
			$table->string('producer');
			$table->string('release_date');
			$table->string('created');
			$table->string('edited');

			// species
			// starships
			// vehicles
			// characters
			// planets
		});

		// Starships
		Schema::create('starships', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('model');
			$table->string('starship_class');
			$table->string('manufacturer');
			$table->string('cost_in_credits');
			$table->string('length');
			$table->string('crew');
			$table->string('passengers');
			$table->string('max_atmosphering_speed');
			$table->string('hyperdrive_rating');
			$table->string('MGLT');
			$table->string('cargo_capacity');
			$table->string('consumables');
			$table->string('created');
			$table->string('edited');

			// films
			// pilots
		});

		// Vehicles
		Schema::create('vehicles', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('model');
			$table->string('vehicle_class');
			$table->string('manufacturer');
			$table->string('length');
			$table->string('cost_in_credits');
			$table->string('crew');
			$table->string('passengers');
			$table->string('max_atmosphering_speed');
			$table->string('cargo_capacity');
			$table->string('consumables');
			$table->string('created');
			$table->string('edited');

			// films
			// pilots
		});

		// Species
		Schema::create('species', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('classification');
			$table->string('designation');
			$table->string('average_height');
			$table->string('average_lifespan');
			$table->string('eye_colors');
			$table->string('hair_colors');
			$table->string('skin_colors');
			$table->string('language');
			$table->string('created');
			$table->string('edited');

			// homeworld (1:n)
			$table->unsignedBigInteger('homeworld_id')->nullable();

			// people (n:n)
			// films (n:n)
		});

		// Planets
		Schema::create('planets', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('rotation_period');
			$table->string('orbital_period');
			$table->string('diameter');
			$table->string('climate');
			$table->string('gravity');
			$table->string('terrain');
			$table->string('surface_water');
			$table->string('population');
			$table->string('created');
			$table->string('edited');

			// residents
			// films
		});

		/**
		 * Create the foreign keys for the models.
		 */

		// People
		Schema::table('people', function (Blueprint $table) {
			$table->foreign('homeworld_id')->references('id')->on('planets');
		});

		// Species
		Schema::table('species', function (Blueprint $table) {
			$table->foreign('homeworld_id')->references('id')->on('planets');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop the foreign keys
		Schema::table('people', function (Blueprint $table) {
			$table->dropForeign('people_homeworld_id_foreign');
		});
		Schema::table('species', function (Blueprint $table) {
			$table->dropForeign('species_homeworld_id_foreign');
		});

		// Drop the base tables
		Schema::dropIfExists('people');
		Schema::dropIfExists('films');
		Schema::dropIfExists('starships');
		Schema::dropIfExists('vehicles');
		Schema::dropIfExists('species');
		Schema::dropIfExists('planets');
	}
}
