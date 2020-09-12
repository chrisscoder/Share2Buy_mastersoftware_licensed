<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDesignersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('designers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('slug')->default('');
			$table->integer('user_id')->nullable();
			$table->string('title')->nullable();
			$table->string('intro')->nullable();
			$table->text('body')->nullable();
			$table->string('image1')->nullable();
            $table->string('imageAlt')->nullable();
			$table->integer('featured')->default(0);
			$table->timestamps();
			$table->string('meta_title')->nullable();
			$table->string('meta_description')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('designers');
	}

}
