<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesRessourceTable extends Migration {

    private $table = 'roles_ressources';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->table, function(Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->string('ressource')->nullable();
            $table->integer('ressource_id')->nullable();
        });

        Schema::table($this->table, function(Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table($this->table, function(Blueprint $table) {
            $table->dropForeign($this->table . '_role_id_foreign');
        });
        Schema::dropIfExists($this->table);
    }

}
