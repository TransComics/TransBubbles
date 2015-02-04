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
            $table->string('title',63);
            $table->string('author',63);
            $table->text('description');
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
