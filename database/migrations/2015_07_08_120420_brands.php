<?php
 
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 
class Brands extends Migration {
 
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    // blog table
    Schema::create('brands', function(Blueprint $table) {
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
  public function down() {
    // drop blog table
    Schema::drop('brands');
  }
 
}