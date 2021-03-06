<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 300);
                        $table->string('short_name',200); // tên rút ngắn cho địa chỉ url
			$table->date('start_day');
			$table->date('end_day');
			$table->text('about_the_course');
			$table->float('cost', 6,2)->default(0.0);
                        $table->enum('status',array('public','pedding','invalid'));
                        $table->softDeletes();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('courses');
	}

}
