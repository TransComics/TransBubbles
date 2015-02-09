<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguages extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
    Schema::create('languages', function(Blueprint $table) {
            $table->char('id', 2);
            $table->char('label', 32)->unique();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('languages');
    }

}
