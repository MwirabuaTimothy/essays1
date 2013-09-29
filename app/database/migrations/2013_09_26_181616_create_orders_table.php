<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->string('topic');
			$table->string('instructions');
			$table->string('subject');
			$table->string('doctype');
			$table->string('pages');
			$table->boolean('single_paced');
			$table->string('style');
			$table->string('academic_level');
			$table->string('page_cost');
			$table->string('total');
			$table->string('currency');
			$table->string('language');
			$table->string('urgency');
			$table->boolean('recieve_calls');
			$table->string('status');
			$table->string('notes');
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
		Schema::drop('orders');
	}

}
