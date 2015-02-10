<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBubblesTable extends Migration {

    private $tabe = 'bubbles';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->table, function(Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('original_id')->unsigned();
            $table->integer('lang_id')->unsigned();
            $table->integer('strip_id')->unsigned();
            $table->text('value');
            $table->timestamps();
        });

        Schema::table($this->table, function(Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on($this->table)
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('original_id')->references('id')->on($this->table)
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('lang_id')->references('id')->on('languages')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('strip_id')->references('id')->on('strips')
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
            $table->dropForeign($this->table.'_parent_id_foreign');
            $table->dropForeign($this->table.'_original_id_foreign');
            $table->dropForeign($this->table.'_lang_id_foreign');
            $table->dropForeign($this->table.'_strip_id_foreign');
        });
        Schema::dropIfExists($this->table);
    }

}
