<?php
 
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 
class Brands extends Migration
{
 
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('brands', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('name');
      $table->integer('user_id') -> unsigned() -> default(0);
      
    });
  }
 
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('brands');
  }
 
}