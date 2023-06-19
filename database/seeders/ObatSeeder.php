<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
 
    public function run()
    {
        \App\Models\Obat::factory()->count(50)->create();
    }
}
