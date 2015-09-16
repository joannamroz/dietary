<?php 
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodsTableSeeder extends Seeder {

    public function run()
    {
       
        DB::table('foods')->delete();

       $rows[] = [
           'id'         => 1,
           'name'       => "Sweet and Nutty peanut",
           'brand_id'   => 1,
           'user_id'    => 1,
           'kcal'       => 499,
           'proteins'   => 13,
           'carbs'      => 48.80,
           'fats'       => 27,
           'fibre'      => 4.40,
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now()
       ];

       $rows[] = [
           'id'         => 2,
           'name'       => "Mazurski smak twaróg półtłusty",
           'brand_id'   => 6,
           'user_id'    => 1,
           'kcal'       => 115,
           'proteins'   => 16,
           'carbs'      => 3.70,
           'fats'       => 4,
           'fibre'      => 0,
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now()
       ];
       $rows[] = [
           'id'         => 3,
           'name'       => "Cukier",
           'brand_id'   => 2,
           'user_id'    => 1,
           'kcal'       => 405,
           'proteins'   => 0,
           'carbs'      => 99.80,
           'fats'       => 0,
           'fibre'      => 0,
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now()
       ];
       $rows[] = [
           'id'         => 4,
           'name'       => "Mleko 3,5%",
           'brand_id'   => 6,
           'user_id'    => 2,
           'kcal'       => 64,
           'proteins'   => 3.20,
           'carbs'      => 4.60,
           'fats'       => 3.50,
           'fibre'      => 0,
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now()
       ];
           
           
       DB::table('foods')->insert($rows);
    }


}