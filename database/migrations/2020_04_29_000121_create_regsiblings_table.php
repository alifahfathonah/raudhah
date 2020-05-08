<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegsiblingsTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('regsiblings', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('registrant_id');
			$table->string('siblingname');
			$table->string('siblingrelation');
			$table->string('siblingnik')->nullable();
			$table->string('siblingphone')->nullable();
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
		Schema::dropIfExists('regsiblings');
	}
}