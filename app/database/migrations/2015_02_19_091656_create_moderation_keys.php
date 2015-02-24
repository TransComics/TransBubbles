<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModerationKeys extends Migration {

    private $tables = [
        'bubbles',
        'comics',
        'strips',
        'shapes'
    ];

    public function up() {
        foreach ($this->tables as $tb) {
            Schema::table($tb, function (Blueprint $table) {
                $table->integer('validated_by')->unsigned()->nullable();
                $table->timestamp('validated_at')->nullable();
                $table->enum('validated_state',['PENDING','VALIDATED','REFUSED'])->default('PENDING');
                $table->string('validated_comments')->nullable();
                
                
                $table->foreign('validated_by')
                    ->references('id')
                    ->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            });
        }
    }

    public function down() {
        foreach ($this->tables as $tb) {
            Schema::table($tb, function(Blueprint $table) use ($tb) {
                $table->dropForeign($tb.'_validated_by_foreign');
            });
        }
        foreach ($this->tables as $tb) {
            Schema::table($tb, function(Blueprint $table){
                $table->dropColumn(['validated_by','validated_at','validated_state','validated_comments']);
            });
        }
    }
}