<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Meals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create('meals', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('food_id');
            $table->integer('planed_food');
            $table ->integer('weight');
            $table->integer('user_id');
            $table->date('date');
            
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
       
        Schema::drop('meals');
    }
}
