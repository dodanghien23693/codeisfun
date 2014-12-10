<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourseInstructorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('course_instructor', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('course_id')->unsigned()->index();			
			$table->integer('user_id')->unsigned()->index();	
                        $table->boolean('is_owner');
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
		Schema::drop('course_instructor');
	}

}
