<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserPermissions extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    Schema::create('user_permissions', function (Blueprint $table)
    {
      $table->increments('id');
      $table->integer('user_id');
      $table->integer('authorized_user_id');
      $table->integer('read_permission');
      $table->integer('write_permission');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('user_permissions', function (Blueprint $table) {
        //
    });
  }
}