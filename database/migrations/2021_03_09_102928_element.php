<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Questions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedSmallInteger('survey_id');
            $table->string('type', 20)->default('radio');
            $table->string('text')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedTinyInteger('position')->nullable();
            $table->boolean('required')->default(0);
            $table->string('options', 1000)->nullable();
            $table->softDeletes();   
            
            //$table->foreign('survey_id')->references('id')->on('survey')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('element');
    }
}
