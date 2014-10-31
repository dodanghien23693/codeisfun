<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLectureViewedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lecture_viewed', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('lecture_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->dateTime('date_view');
			$table->timestamps();
                        
                        $table->foreign('lecture_id')->references('id')->on('lectures');
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
		Schema::drop('lecture_viewed');
	}

}
