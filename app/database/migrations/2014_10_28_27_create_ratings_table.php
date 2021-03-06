<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ratings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->integer('post_id')->unsigned()->index();
			$table->integer('rating')->default(0);
			$table->timestamps();
                        
                        $table->foreign('user_id')->references('id')->on('users');
                        $table->foreign('post_id')->references('id')->on('posts');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ratings');
	}

}
