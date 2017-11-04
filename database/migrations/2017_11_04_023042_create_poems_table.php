<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poems', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('author_id')->references('id')->on('authors');
            $table->integer('author_id')->unsigned()->references('id')->on('authors');
            $table->integer('category_id')->unsigned()->references('id')->on('categories')->default(6);
            $table->integer('position')->unsigned();
            $table ->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poems');
    }
}
