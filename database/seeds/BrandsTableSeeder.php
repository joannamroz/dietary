<?php 
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder {

    public function run()
    {
       
        DB::table('brands')->delete();

       $rows[] = [
           'id'         => 1,
           'name'       => "Nature Valley",
           'user_id'    => 1
           
       ];

       $rows[] = [
           'id'         => 2,
           'name'       => "Tesco",
           'user_id'    => 1
           
       ];
       $rows[] = [
           'id'         => 3,
           'name'       => "Zott",
           'user_id'    => 1
           
       ];

       $rows[] = [
           'id'         => 4,
           'name'       => "Coca cola",
           'user_id'    => 1
           
       ];

       $rows[] = [
           'id'         => 5,
           'name'       => "Nescaffee",
           'user_id'    => 1
           
       ];

       $rows[] = [
           'id'         => 6,
           'name'       => "Mlekpol",
           'user_id'    => 1
           
       ];       
       DB::table('brands')->insert($rows);
    }


}