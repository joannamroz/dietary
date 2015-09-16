<?php 
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasurementsTableSeeder extends Seeder {

    public function run()
    {
       
        DB::table('measurements')->delete();

       $rows[] = [
           'id'             => 1,
           'user_id'        => 1,
           'date'           => date('2015-08-15'),
           'comment'        => "No comment",
           'body_fat'       => 28,
           'water'          => 50,
           'muscle'         => 41,
           'internal_fat'   => 27,
           'bmi'            => 21.3,
           'weight'         => 59.5,
           'height'         => 165,
           'waist'          => 0,
           'chest'          => 0,
           'neck'           => 0,
           'hips'           => 0,
           'biceps'         => 0,
           'bust'           => 0,
           'thigh'          => 0,
           'upper_arm'      => 0,
           'created_at'     => Carbon::now(),
           'updated_at'     => Carbon::now()
       ];

       $rows[] = [
           'id'             => 2,
           'user_id'        => 1,
           'date'           => date('2015-02-15'),
           'comment'        => "No comment",
           'body_fat'       => 29,
           'water'          => 51,
           'muscle'         => 40,
           'internal_fat'   => 29,
           'bmi'            => 21.7,
           'weight'         => 60,
           'height'         => 165,
           'waist'          => 0,
           'chest'          => 0,
           'neck'           => 0,
           'hips'           => 0,
           'biceps'         => 0,
           'bust'           => 0,
           'thigh'          => 0,
           'upper_arm'      => 0,
           'created_at'     => Carbon::now(),
           'updated_at'     => Carbon::now()
       ];

       
           
       DB::table('measurements')->insert($rows);
    }


}