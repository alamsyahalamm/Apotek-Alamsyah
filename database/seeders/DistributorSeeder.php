<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DistributorSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Distributor::factory()->count(15)->create();
    }
}
