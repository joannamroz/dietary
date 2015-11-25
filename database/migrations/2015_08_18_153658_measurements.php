<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Measurements extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {   
    Schema::create('measurements', function (Blueprint $table)
    {
      $table->increments('id');
      $table->integer('user_id');
      $table->date('date');
      $table->string('comment');
      $table->integer('body_fat');
      $table->integer('water');
      $table->integer('muscle');
      $table->integer('internal_fat');
      $table->integer('bmi');
      $table->integer('weight');
      $table->integer('height');
      $table->integer('waist');
      $table->integer('chest');
      $table->integer('neck');
      $table->integer('hips');
      $table->integer('biceps');
      $table->integer('bust');
      $table->integer('thigh');
      $table->integer('upper_arm');
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
    Schema::drop('measurements');
  }
}
