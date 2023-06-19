<?php

namespace Database\Factories;

use App\Models\Distributor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DistributorFactory extends Factory
{
    protected $model = Distributor::class;
    
    public function definition()
    {
        return [
            'Kode_Distributor' => $this->faker->unique()->numerify('KD######'),
            'Nama_Distributor' => $this->faker->company,
        ];
    }
}
