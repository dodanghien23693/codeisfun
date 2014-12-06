<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->string('description', 300);
			$table->boolean('is_read');
			$table->integer('type_notification_id')->unsigned()->index();
			$table->timestamps();
                        
                        $table->foreign('user_id')->references('id')->on('users');
                        $table->foreign('type_notification_id')->references('id')->on('notifications');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notifications');
	}

}
