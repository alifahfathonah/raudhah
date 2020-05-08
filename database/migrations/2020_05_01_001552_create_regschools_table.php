<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegschoolsTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('regschools', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('registrant_id');
			$table->string('schfrom');
			$table->string('schlvl');
			$table->string('schname');
			$table->text('schstreet');
			$table->string('schprov');
			$table->string('schkab');
			$table->string('schkec');
			$table->string('schkel');
			$table->string('schpsn')->nullable();
			$table->string('schun')->nullable();
			$table->string('schijazah')->nullable();
			$table->string('schskhun')->nullable();
			$table->boolean('pindahan')->default(false);
			$table->string('psnfrom')->nullable();
			$table->text('psnadd')->nullable();
			$table->string('psnwhy')->nullable();
			$table->text('psndesc')->nullable();
			$table->string('psnup')->nullable();
			$table->string('psnlvl')->nullable();
			$table->string('psnto')->nullable();
			$table->boolean('psnrep')->default(false);
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
		Schema::dropIfExists('regschools');
	}
}