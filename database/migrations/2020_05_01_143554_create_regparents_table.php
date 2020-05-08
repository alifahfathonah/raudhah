<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegparentsTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('regparents', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('registrant_id');
			// ayah
			$table->string('fname');
			$table->boolean('flive')->default(true);
			$table->text('fadd');
			$table->string('fprov');
			$table->string('fkab');
			$table->string('fkec');
			$table->string('fkel');
			$table->string('fphone');
			$table->string('fwa')->nullable();
			$table->string('fktp');
			$table->string('fedu');
			$table->string('freli');
			$table->boolean('fmari')->default(true);
			$table->string('fwork');
			$table->string('fsal');
			$table->string('faddsal')->default('0');
			// ibu
			$table->string('mname');
			$table->boolean('mlive')->default(true);
			$table->text('madd');
			$table->string('mprov');
			$table->string('mkab');
			$table->string('mkec');
			$table->string('mkel');
			$table->string('mphone');
			$table->string('mwa')->nullable();
			$table->string('mktp');
			$table->string('medu');
			$table->string('mreli');
			$table->string('mwork');
			$table->string('msal');
			$table->string('maddsal')->default('0');
			// donatur
			$table->boolean('pembiayaan')->default(true);
			$table->string('donaturname')->nullable();
			$table->string('donaturrels')->nullable();
			$table->string('donaturphone')->nullable();
			$table->text('donaturadd')->nullable();
			$table->string('dprov')->nullable();
			$table->string('dkab')->nullable();
			$table->string('dkec')->nullable();
			$table->string('dkel')->nullable();
			// berkas
			$table->boolean('berkasijz')->default(true);
			$table->boolean('berkasskhun')->default(true);
			$table->boolean('berkasnisn')->default(true);
			$table->boolean('berkaskk')->default(true);
			$table->boolean('berkasktp')->default(true);
			$table->boolean('berkasfoto')->default(true);
			$table->boolean('berkasrapor')->default(true);
			$table->boolean('berkasskbb')->default(true);
			$table->boolean('berkaskes')->default(true);
			
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
		Schema::dropIfExists('regparents');
	}
}