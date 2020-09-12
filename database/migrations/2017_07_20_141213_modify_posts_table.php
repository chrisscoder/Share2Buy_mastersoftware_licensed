<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('cover')->after('body')->nullable();
            $table->string('hero_type')->after('cover')->nullable();
            $table->string('hero')->after('hero_type')->nullable();
            $table->string('meta_title')->after('hero')->nullable();
            $table->string('meta_description')->after('meta_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('cover');
            $table->dropColumn('hero_type');
            $table->dropColumn('hero');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
        });
    }
}
