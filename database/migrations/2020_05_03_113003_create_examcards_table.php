<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examcards', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('registrant_id');
						$table->bigInteger('index');
						$table->string('numchar')->unique();
						$table->bigInteger('room_id')->nullable();
						$table->bigInteger('classroom_id')->nullable();
						$table->bigInteger('foodtable_id')->nullable();
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
        Schema::dropIfExists('examcards');
    }
}