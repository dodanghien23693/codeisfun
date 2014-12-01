<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourseFaqTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('course_faq', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('course_id')->unsigned()->index();
			$table->text('question');
			$table->text('answer');
                        $table->integer('asker_id')->unsigned()->index();
                        $table->integer('responser_id')->unsigned()->index();
			$table->dateTime('date');
			$table->timestamps();
                        
                        $table->foreign('course_id')->references('id')->on('courses');
                        $table->foreign('asker_id')->references('id')->on('users');
                        $table->foreign('responser_id')->references('id')->on('users');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('course_faq');
	}

}
