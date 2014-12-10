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
                        $table->integer('uses_id')->unsigned()->index();
			$table->string('name', 300);
			$table->integer('max_attempts');
			$table->integer('duration_minus');
			$table->date('due_date');
			$table->date('hard_deadline');
			$table->string('description', 500);
			$table->timestamps();
                        
                        $table->foreign('course_id')->references('id')->on('courses');
                        $table->foreign('user_id')->references('id')->on('users');
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
