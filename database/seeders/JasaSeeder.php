<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JasaSeeder extends Seeder
{
    
    public function run()
    {
        \App\Models\Jasa::factory()->count(10)->create();
    }
}
