<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPeopleAddLinkImageAffiliations extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('people', function (Blueprint $table) {
			$table->string('wiki_link')->nullable()->after('skin_color');
			$table->string('image_url')->nullable()->after('wiki_link');
			// affiliations is an array of strings with default to empty
			$table->longtext('affiliations')->nullable()->after('image_url');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('people', function (Blueprint $table) {
			$table->dropColumn('wiki_link');
			$table->dropColumn('image_url');
			$table->dropColumn('affiliations');
		});
	}
}
