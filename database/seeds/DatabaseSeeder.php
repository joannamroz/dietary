<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');
        $this->command->info('User table seeded!');
        $this->call('BrandsTableSeeder');
        $this->command->info('Brands table seeded!');
        $this->call('FoodsTableSeeder');
        $this->command->info('Foods table seeded!');
        $this->call('MeasurementsTableSeeder');
        $this->command->info('Measurements table seeded!');
        // $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
