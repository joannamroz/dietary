<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ingredients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('ingredients', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('food_id');
            $table->integer('ingredient_id');
            $table->integer('user_id');
            $table->integer('weight');
            $table->timestamps();
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('ingredients');
    }
}
