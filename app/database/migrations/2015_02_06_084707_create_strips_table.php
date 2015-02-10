<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStripsTable extends Migration {

	public function up()
	{
		Schema::create('strips', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 64);
			$table->string('path', 64);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('strips');
	}
}