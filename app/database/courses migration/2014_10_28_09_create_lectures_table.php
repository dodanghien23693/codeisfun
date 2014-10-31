<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLecturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lectures', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 300);
			$table->integer('chapter_id')->unsigned()->index();
			$table->integer('order_of_lecture')->default(0);
			$table->text('description');
			$table->timestamps();
                        
                        $table->foreign('chapter_id')->references('id')->on('chapters');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lectures');
	}

}
