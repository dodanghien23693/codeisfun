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
			$table->string('description', 300);
                        $table->string('link',300);
			$table->integer('type_notification_id')->unsigned()->index();
                        $table->integer('model_type');
                        $table->integer('model_id');
			$table->timestamps();
                        
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
