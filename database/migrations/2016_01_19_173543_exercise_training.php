<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExerciseTraining extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise_training', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('exercise_id');
            $table->integer('training_id');
            $table->integer('user_id');
            $table->integer('num_of_exercises');
            $table->integer('num_of_series');
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
        Schema::drop('exercise_training');
    }
}
