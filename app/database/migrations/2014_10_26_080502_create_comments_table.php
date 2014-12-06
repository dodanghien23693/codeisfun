<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->text('content');
			$table->integer('commentable_id')->unsigned();
			$table->string('commentable_type');
			$table->integer('parent_commentable_id')->unsigned();
			$table->timestamps();
                        
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
		Schema::drop('comments');
	}

}
