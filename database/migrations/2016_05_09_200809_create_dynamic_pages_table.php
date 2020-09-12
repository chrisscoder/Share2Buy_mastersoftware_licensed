<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDynamicPagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dynamic_pages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('slug');
			$table->string('title');
			$table->string('intro');
			$table->text('body');
			$table->string('image1')->nullable();
			$table->timestamps();
			$table->string('meta_title')->nullable();
			$table->string('meta_description')->nullable();
			$table->string('menu_place')->nullable();
			$table->string('menu_title')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dynamic_pages');
	}

}
