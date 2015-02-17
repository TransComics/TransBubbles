<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVotesTable extends Migration {

    public function up() {
        Schema::create('votes', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('strip_id')->unsigned();
            $table->integer('lang_id')->unsigned();
            $table->integer('bubble_id');
            $table->timestamps();
            
            $table->primary(array(
                'user_id',
                'strip_id',
                'lang_id'
            ));
        });
        
        Schema::table('votes', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('votes', function (Blueprint $table) {
            $table->foreign('strip_id')
                ->references('id')
                ->on('strips')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('votes', function (Blueprint $table) {
            $table->foreign('lang_id')
                ->references('id')
                ->on('languages')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    public function down() {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign('votes_user_id_foreign');
        });
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign('votes_strip_id_foreign');
        });
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign('votes_lang_id_foreign');
        });
        Schema::drop('votes');
    }
}