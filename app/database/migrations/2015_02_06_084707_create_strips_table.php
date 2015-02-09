<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStripsTable extends Migration {

	public function up()
	{
		Schema::create('strips', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 64);
			$table->string('author', 255);
			$table->date('insertion_date');
			$table->string('path', 64);
			$table->integer('pageNumber');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('strips');
	}
}