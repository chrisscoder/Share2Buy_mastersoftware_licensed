<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id');
			$table->integer('quantity');
			$table->string('size')->nullable()->default('');
			$table->float('total');
			$table->string('name');
			$table->string('address');
			$table->string('postal');
			$table->string('city');
			$table->string('phone');
			$table->string('email');
			$table->string('status')->default('pending');
			$table->timestamps();
			$table->string('stripetoken')->nullable();
			$table->integer('handled')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
