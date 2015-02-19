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
            $table->increments('id');
            $table->char('shortcode', 2);
            $table->char('codeiso', 3);
            $table->char('code', 5)->unique();
            $table->char('label', 32)->unique();
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
