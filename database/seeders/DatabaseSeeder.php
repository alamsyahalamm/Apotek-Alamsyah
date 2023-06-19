<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $faker->seed(123);

        $this->call(ObatSeeder::class);
        $this->call(JasaSeeder::class);
        $this->call(DistributorSeeder::class);
        $this->call(UserSeeder::class);
    }
}
