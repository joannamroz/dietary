<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Foods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
    
        Schema::create('foods', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('brand_id') -> unsigned() -> default(0);
            $table->integer('user_id');
            $table->float('kcal');
            $table->float('proteins');
            $table->float('carbs');
            $table->float('fats');
            $table->float('fibre');
            $table->integer('planed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        
        Schema::drop('foods');
    }
}
