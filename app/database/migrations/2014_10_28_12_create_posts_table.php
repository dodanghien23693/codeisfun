<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->string('slug', 300);
			$table->string('title', 300);
			$table->string('cover_image_url', 500)->default('');
			$table->text('description');
			$table->mediumText('content');
			$table->integer('post_status_id')->unsigned()->index();
			$table->dateTime('public_time');
			$table->integer('view_count')->default(0);
			$table->integer('comment_count')->default(0);
			$table->timestamps();
                        $table->softDeletes();
                        
                        $table->foreign('user_id')->references('id')->on('users');
                        $table->foreign('post_status_id')->references('id')->on('post_status');
                     
                        
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
