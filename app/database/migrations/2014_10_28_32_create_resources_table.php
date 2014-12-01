<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResourcesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resources', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('resource_type_id')->unsigned()->index();
			$table->string('path', 500);
			$table->integer('lecture_id')->unsigned()->index();
			$table->timestamps();
                        
                        $table->foreign('lecture_id')->references('id')->on('lectures');
                        $table->foreign('resource_type_id')->references('id')->on('resources');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resources');
	}

}
