<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserNotificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_notification', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
                        $table->integer('notification_id')->unsigned()->index();
			$table->boolean('is_read');
                        
			$table->timestamps();
                        $table->foreign('user_id')->references('id')->on('users');
                        $table->foreign('notification_id')->references('id')->on('notifications');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_notification');
	}

}
