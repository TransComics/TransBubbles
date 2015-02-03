<?php

use Illuminate\Database\Migrations\Migration;

class CreateComics extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comics', function($table) {
            $table->increments('id');
            $table->string('title');
            $table->smallInteger('page');
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
        Schema::dropIfExists('comics');
    }

}
