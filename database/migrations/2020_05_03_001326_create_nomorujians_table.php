<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNomorujiansTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('nomorujians', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('registrant_id');
			$table->bigInteger('index');
			$table->string('number');
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
		Schema::dropIfExists('nomorujians');
	}
}