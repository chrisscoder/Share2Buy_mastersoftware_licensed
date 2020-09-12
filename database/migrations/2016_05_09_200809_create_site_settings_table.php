<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiteSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_settings', function(Blueprint $table)
		{
			$table->integer('featured_product');
			$table->integer('featured_designer');
			$table->integer('best_selling_designer');
			$table->integer('best_selling_designer_product')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('site_settings');
	}

}
