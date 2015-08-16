<?php 
class UserTableSeeder extends Seeder {

    public function run()
    {
       
        DB::table('users')->delete();

       $rows[] = [
           'id'         => 1,
           'name'       => "admin",
           'email'      => "admin@example.com",
           'role'       => "admin",
           'password'   => bcrypt("admin"),
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now()
       ];

       $rows[] = [
           'id'         => 2,
           'name'       => "admin2",
           'email'      => "admin2@example.com",
           'role'       => "admin",
           'password'   => bcrypt("admin2"),
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now()
       ];

       DB::table('users')->insert($rows);
    }


}