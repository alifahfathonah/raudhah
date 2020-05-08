<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrants', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('indexno');
						$table->string('years');
						$table->string('nova');
						$table->string('destination');
						$table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
						$table->string('password');
						$table->string('kknumber');
						$table->string('username')->unique(); // NIK
						$table->string('name');
						$table->string('nickname');
						$table->string('nisn');
						$table->tinyInteger('gender')->default(1);
						$table->string('bloodtype')->nullable();
						$table->integer('weight')->nullable();
						$table->integer('height')->nullable();
						$table->string('birthplace');
						$table->date('birthdate');
						$table->string('consulat')->nullable();
						$table->string('hobby')->nullable();
						$table->string('wishes')->nullable();
						$table->string('achievement')->nullable();
						$table->text('competition')->nullable();
						$table->integer('siblings');
						$table->integer('stepsiblings');
						$table->integer('totalsiblings');
						$table->integer('numposition');
						$table->string('paynumber')->nullable();
						$table->date('paydate')->nullable();
						$table->bigInteger('paynominal')->nullable();
						$table->string('paybankaccount')->nullable();
						$table->string('payimg')->nullable();
						$table->boolean('isverified')->default(false);
						$table->boolean('manualverify')->default(false);
						$table->date('verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('registrants');
    }
}