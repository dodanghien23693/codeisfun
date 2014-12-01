<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizzesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quizzes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('course_id')->unsigned()->index();
			$table->string('name', 300);
			$table->integer('max_attampts');
			$table->integer('duration_minus');
			$table->dateTime('due_date');
			$table->dateTime('hard_deadline');
			$table->string('description', 500);
			$table->timestamps();
                        
                        $table->foreign('course_id')->references('id')->on('courses');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quizzes');
	}

}
