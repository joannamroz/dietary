<?php 
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExercisesTableSeeder extends Seeder
{

  public function run()
  {
     
    DB::table('exercises')->delete();

    $rows[] = [
       'id'             => 1,
       'user_id'        => 1,
       'name'           => 'Pompki / Pushups',
       'description'    => 'Kazdy wie jak!',
       'created_at'     => Carbon::now(),
       'updated_at'     => Carbon::now()
    ];

    $rows[] = [
       'id'             => 2,
       'user_id'        => 1,
       'name'           => 'Przysiady / Squats',
       'description'    => 'Stań z nogami rozstawionymi na szerokość bioder, rozluźnij nieco kolana, wyprostuj plecy, napnij brzuch. Stopniowo obniżaj ciało przesuwając biodra do tyłu, tak jakbyś chciała usiąść na krześle, do momentu aż uda będą ustawione równolegle do podłoża (inna wersja: powinny tworzyć wraz z podudziami kąt 90°). Następnie wstań nie prostując nóg do końca, tak aby mięśnie nóg były cały czas napięte',
       'created_at'     => Carbon::now(),
       'updated_at'     => Carbon::now()
    ];

 DB::table('exercises')->insert($rows);
  }


}