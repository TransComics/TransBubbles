<?php 

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComics extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('comics', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title',63)->unique();
            $table->string('author',63);
            $table->text('description');
            $table->boolean('authorApproval');
            $table->string('cover',127)->nullable();
            $table->integer('font_id')->unsigned()->nullable();
            $table->timestamps();
        });
        
        Schema::table('comics', function(Blueprint $table) {
            $table->foreign('font_id')->references('id')->on('fonts')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('comics', function(Blueprint $table) {
            $table->dropForeign('comics_font_id_foreign');
        });
        Schema::dropIfExists('comics');
    }

}
