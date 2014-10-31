<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('quiz_id')->unsigned()->index();
			$table->text('question');
			$table->integer('question_type_id')->unsigned()->index();
			$table->integer('order_of_question')->default(0);
			$table->timestamps();
                        
                        $table->foreign('quiz_id')->references('id')->on('quizzes');
                        $table->foreign('question_type_id')->references('id')->on('question_type');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('questions');
	}

}
