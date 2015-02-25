<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStripsTable extends Migration {

    public function up() {
        Schema::create('strips', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64);
            $table->string('path');
            $table->boolean('isShowable')->default(false);
            $table->integer('comic_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('index')->unsigned();
            $table->unique(['comic_id', 'index']);
            $table->timestamps();
        });

        Schema::table('strips', function(Blueprint $table) {
            $table->foreign('comic_id')->references('id')->on('comics')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
        });
    }

    public function down() {
        Schema::table('strips', function(Blueprint $table) {
            $table->dropForeign('strips_comic_id_foreign');
            $table->dropForeign('strips_user_id_foreign');
        });

        Schema::drop('strips');
    }

}
