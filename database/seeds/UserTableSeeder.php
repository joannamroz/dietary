<?php 
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserTableSeeder extends Seeder {

    public function run()
    {
       
        DB::table('users')->delete();

       $rows[] = [
           'id'             => 1,
           'name'           => "admin",
           'email'          => "admin@example.com",
           'sex'            => "female",
           'date_of_birth'  => Carbon::createFromDate(1988, 9, 03)->toDateString(),
           'role'           => "user",
           'password'       => bcrypt("admin"),
           'created_at'     => Carbon::now(),
           'updated_at'     => Carbon::now()
       ];

       $rows[] = [
           'id'             => 2,
           'name'           => "admin2",
           'email'          => "admin2@example.com",
           'sex'            => "male",
           'date_of_birth'  => Carbon::createFromDate(1987, 04, 22)->toDateString(),
           'role'           => "user",
           'password'       => bcrypt("admin2"),
           'created_at'     => Carbon::now(),
           'updated_at'     => Carbon::now()
       ];

       DB::table('users')->insert($rows);
    }


}