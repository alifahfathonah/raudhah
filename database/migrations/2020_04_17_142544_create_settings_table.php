<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('settings', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->boolean('registration')->default(false);
			$table->string('years');
			$table->bigInteger('cost');
			$table->string('nova');
			$table->string('name');
			$table->string('prefix')->nullable();
			$table->string('suffix')->nullable();
			$table->string('shorts')->nullable();
			$table->string('company')->nullable();
			$table->text('address')->nullable();
			$table->string('city')->nullable();
			$table->integer('postal')->nullable();
			$table->string('phone')->nullable();
			$table->string('mobile')->nullable();
			$table->string('email')->nullable();
			$table->string('fax')->nullable();
			$table->string('logo')->nullable();
			$table->string('web')->nullable();
			$table->string('fb')->nullable();
			$table->string('ig')->nullable();
			$table->string('tw')->nullable();
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
		Schema::dropIfExists('settings');
	}
}