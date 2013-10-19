<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateXfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('xfiles', function(Blueprint $table) {
			$table->increments('id');
			$table->string('url');
			$table->string('title');
			$table->string('order_id');
			$table->string('user_id');
			$table->integer('downloads');
			$table->string('category');
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
		Schema::drop('xfiles');
	}

}
