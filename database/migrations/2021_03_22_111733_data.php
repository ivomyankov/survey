<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Data extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('survey_id');
            $table->json('data');
            $table->string('question_id', 500);
            $table->unsignedSmallInteger('applicants_id')->nullable();
            $table->string('result', 10000);
            $table->dateTime('created_at');

            //$table->foreign('elements_id')->references('id')->on('elements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
