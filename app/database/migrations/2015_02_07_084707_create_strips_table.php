<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStripsTable extends Migration {

    public function up() {
        Schema::create('strips', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64);
            $table->string('path');
            $table->timestamp('validated_at')->nullable();
            $table->integer('comic_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('strips', function(Blueprint $table) {
            $table->foreign('comic_id')->references('id')->on('comics')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
        });
    }

    public function down() {
        Schema::table('strips', function(Blueprint $table) {
            $table->dropForeign('strips_comic_id_foreign');
        });

        Schema::drop('strips');
    }

}
