<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtendedMetadataToResources extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('people', function (Blueprint $table) {
			if (!Schema::hasColumn('people', 'short_description')) {
				$table->text('short_description')->nullable()->after('affiliations');
			}

			if (!Schema::hasColumn('people', 'long_description')) {
				$table->longText('long_description')->nullable()->after('short_description');
			}

			if (!Schema::hasColumn('people', 'force_alignment')) {
				$table->string('force_alignment')->nullable()->after('long_description');
			}

			if (!Schema::hasColumn('people', 'lightsaber_color')) {
				$table->string('lightsaber_color')->nullable()->after('force_alignment');
			}
		});

		Schema::table('films', function (Blueprint $table) {
			if (!Schema::hasColumn('films', 'short_description')) {
				$table->text('short_description')->nullable()->after('image_url');
			}

			if (!Schema::hasColumn('films', 'long_description')) {
				$table->longText('long_description')->nullable()->after('short_description');
			}
		});

		foreach (['planets', 'species', 'starships', 'vehicles'] as $tableName) {
			Schema::table($tableName, function (Blueprint $table) use ($tableName) {
				if (!Schema::hasColumn($tableName, 'image_url')) {
					$table->string('image_url')->nullable()->after('edited');
				}

				if (!Schema::hasColumn($tableName, 'short_description')) {
					$table->text('short_description')->nullable()->after('image_url');
				}

				if (!Schema::hasColumn($tableName, 'long_description')) {
					$table->longText('long_description')->nullable()->after('short_description');
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
		Schema::table('people', function (Blueprint $table) {
			foreach (['short_description', 'long_description', 'force_alignment', 'lightsaber_color'] as $column) {
				if (Schema::hasColumn('people', $column)) {
					$table->dropColumn($column);
				}
			}
		});

		Schema::table('films', function (Blueprint $table) {
			foreach (['short_description', 'long_description'] as $column) {
				if (Schema::hasColumn('films', $column)) {
					$table->dropColumn($column);
				}
			}
		});

		foreach (['planets', 'species', 'starships', 'vehicles'] as $tableName) {
			Schema::table($tableName, function (Blueprint $table) use ($tableName) {
				foreach (['image_url', 'short_description', 'long_description'] as $column) {
					if (Schema::hasColumn($tableName, $column)) {
						$table->dropColumn($column);
					}
				}
			});
		}
	}
}
