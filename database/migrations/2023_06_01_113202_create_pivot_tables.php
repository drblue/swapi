<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/**
		 * Create the pivot tables for the models.
		 *
		 * film_person
		 * film_planet
		 * film_species
		 * film_starship
		 * film_vehicle
		 * person_species
		 * person_starship
		 * person_vehicle
		 */

		// film_person
		Schema::create('film_person', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('film_id');
			$table->unsignedBigInteger('person_id');

			$table->foreign('film_id')->references('id')->on('films');
			$table->foreign('person_id')->references('id')->on('people');
		});

		// film_planet
		Schema::create('film_planet', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('film_id');
			$table->unsignedBigInteger('planet_id');

			$table->foreign('film_id')->references('id')->on('films');
			$table->foreign('planet_id')->references('id')->on('planets');
		});

		// film_species
		Schema::create('film_species', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('film_id');
			$table->unsignedBigInteger('species_id');

			$table->foreign('film_id')->references('id')->on('films');
			$table->foreign('species_id')->references('id')->on('species');
		});

		// film_starship
		Schema::create('film_starship', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('film_id');
			$table->unsignedBigInteger('starship_id');

			$table->foreign('film_id')->references('id')->on('films');
			$table->foreign('starship_id')->references('id')->on('starships');
		});

		// film_vehicle
		Schema::create('film_vehicle', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('film_id');
			$table->unsignedBigInteger('vehicle_id');

			$table->foreign('film_id')->references('id')->on('films');
			$table->foreign('vehicle_id')->references('id')->on('vehicles');
		});

		// person_species
		Schema::create('person_species', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('person_id');
			$table->unsignedBigInteger('species_id');

			$table->foreign('person_id')->references('id')->on('people');
			$table->foreign('species_id')->references('id')->on('species');
		});

		// person_starship
		Schema::create('person_starship', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('person_id');
			$table->unsignedBigInteger('starship_id');

			$table->foreign('person_id')->references('id')->on('people');
			$table->foreign('starship_id')->references('id')->on('starships');
		});

		// person_vehicle
		Schema::create('person_vehicle', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('person_id');
			$table->unsignedBigInteger('vehicle_id');

			$table->foreign('person_id')->references('id')->on('people');
			$table->foreign('vehicle_id')->references('id')->on('vehicles');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		/**
		 * Drop the pivot tables for the models.
		 *
		 * film_person
		 * film_planet
		 * film_species
		 * film_starship
		 * film_vehicle
		 * person_species
		 * person_starship
		 * person_vehicle
		 */

		// film_person
		Schema::dropIfExists('film_person');

		// film_planet
		Schema::dropIfExists('film_planet');

		// film_species
		Schema::dropIfExists('film_species');

		// film_starship
		Schema::dropIfExists('film_starship');

		// film_vehicle
		Schema::dropIfExists('film_vehicle');

		// person_species
		Schema::dropIfExists('person_species');

		// person_starship
		Schema::dropIfExists('person_starship');

		// person_vehicle
		Schema::dropIfExists('person_vehicle');
	}
}
