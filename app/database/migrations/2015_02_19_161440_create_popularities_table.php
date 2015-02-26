<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePopularitiesTable extends Migration {

    public function up() {
        Schema::create('popularities', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('vote_up')->default('0');
            $table->integer('vote_down')->default('0');
            $table->integer('strip_id')->unsigned();
        });

        Schema::table('popularities', function(Blueprint $table) {
            $table->foreign('strip_id')->references('id')->on('strips')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down() {
        Schema::table('popularities', function(Blueprint $table) {
            $table->dropForeign('popularities_strip_id_foreign');
        });
        Schema::drop('popularities');
    }

}
