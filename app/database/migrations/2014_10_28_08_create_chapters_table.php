<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChaptersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chapters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 300);
			$table->integer('course_id')->unsigned()->index();
                        $table->integer('user_id')->unsigned()->index();
                        $table->integer('user_id')->unsigned();   
			$table->integer('order_of_chapter')->default(0);
			$table->text('description');
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
		Schema::drop('chapters');
	}

}
