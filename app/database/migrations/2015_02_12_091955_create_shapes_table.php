<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShapesTable extends Migration {

    private $table = 'shapes';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->table, function(Blueprint $table) {
            $table->increments('id');
            $table->integer('strip_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->longtext('value');
            $table->timestamps();
        });
        Schema::table($this->table, function(Blueprint $table) {
            $table->foreign('strip_id')->references('id')->on('strips')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table($this->table, function(Blueprint $table) {
            $table->dropForeign($this->table . '_strip_id_foreign');
            $table->dropForeign($this->table . '_user_id_foreign');
        });
        Schema::dropIfExists($this->table);
    }

}
