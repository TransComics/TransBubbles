<?php 

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComics extends Migration {

    private $tbl = 'comics';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tbl, function(Blueprint $table) {
            $table->increments('id');
            $table->string('title',63)->unique();
            $table->string('author',63);
            $table->text('description');
            $table->boolean('authorApproval');
            $table->string('cover',127)->nullable();
            $table->integer('font_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('lang_id')->unsigned();
            $table->timestamps();
        });
        
        Schema::table($this->tbl, function(Blueprint $table) {
            $table->foreign('font_id')->references('id')->on('fonts')
                ->onUpdate('cascade')
                ->onDelete('set null');
            
            $table->foreign('created_by')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
            
            $table->foreign('lang_id')->references('id')->on('languages')
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
        Schema::table($this->tbl, function(Blueprint $table) {
            $table->dropForeign($this->tbl.'_font_id_foreign');
            $table->dropForeign($this->tbl.'_created_by_foreign');
            $table->dropForeign($this->tbl.'_lang_id_foreign');
        });
        Schema::dropIfExists($this->tbl);
    }

}
