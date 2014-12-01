<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizSubmitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quiz_submit', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('quiz_id')->unsigned()->index();
			$table->dateTime('date_submit');
			$table->float('score_submit', 6,2); // điểm của người dùng trong lần submit này
			$table->integer('user_id')->unsigned()->index();
			$table->float('score_quiz',6,2); // điểm tối đa mà người chơi có thể đạt được
			$table->timestamps();
                        
                        $table->foreign('quiz_id')->references('id')->on('quizzes');
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
		Schema::drop('quiz_submit');
	}

}
