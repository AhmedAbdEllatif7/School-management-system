<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradesTable extends Migration {

	public function up()
	{
		Schema::create('grades', function(Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->string('name');
			$table->string('notes')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('grades');
	}
}
