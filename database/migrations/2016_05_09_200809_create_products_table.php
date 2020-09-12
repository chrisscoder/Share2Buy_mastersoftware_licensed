<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('slug');
			$table->string('title')->nullable();
			$table->string('intro')->nullable();
			$table->text('body')->nullable();
			$table->timestamp('start_date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('end_date')->nullable();
			$table->float('price')->nullable();
			$table->timestamps();
			$table->string('meta_title')->nullable();
			$table->string('meta_description')->nullable();
			$table->integer('designer_id');
			$table->string('headerImage')->nullable();
			$table->string('headerImageAlt')->nullable();
			$table->string('gridImage')->nullable();
			$table->string('gridImageAlt')->nullable();
			$table->string('sectionTopImage')->nullable();
			$table->string('sectionTopImageAlt')->nullable();
			$table->string('sectionBottomImage')->nullable();
			$table->string('sectionBottomImageAlt')->nullable();
			$table->string('galleryLeftImage')->nullable();
			$table->string('galleryLeftImageAlt')->nullable();
			$table->string('galleryRightImage')->nullable();
			$table->string('galleryRightImageAlt')->nullable();
			$table->string('materials')->nullable();
			$table->string('colour')->nullable();
			$table->string('type')->nullable();
			$table->string('type_value')->nullable();
			$table->string('kategori')->nullable();
			$table->integer('periode')->nullable();
			$table->integer('online')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
