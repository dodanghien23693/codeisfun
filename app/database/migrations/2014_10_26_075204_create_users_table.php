<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email', 200);
			$table->string('password', 64);
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->integer('role_id')->unsigned()->index();
			$table->enum('gender');
			$table->date('birthday');
			$table->string('facebook_link', 300);
			$table->string('googleplus_link', 300);
			$table->string('twitter_link', 300);
			$table->string('website_url', 500);
			$table->string('photo_url', 500);
			$table->text('about_me');
			$table->timestamps();
                        
                        $table->foreign('role_id')->references('id')->on('roles');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
