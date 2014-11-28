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
                        $table->string('username', 50)->unique();
			$table->string('email', 200);
			$table->string('password', 64);
			$table->string('first_name', 50)->nullable();
			$table->string('last_name', 50)->nullable();
			$table->integer('role_id')->unsigned()->index();
			$table->enum('gender',array('male','female'))->nullable();
                        $table->enum('user_type',array('codeisfun','facebook','google'))->default('codeisfun');
                        
			$table->date('birthday')->nullable();
			$table->string('facebook_link', 300)->nullable();
			$table->string('googleplus_link', 300)->nullable();
			$table->string('twitter_link', 300)->nullable();
			$table->string('website_url', 500)->nullable();
			$table->string('photo_url', 500)->nullable();
			$table->text('about_me')->nullable();
                        
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
