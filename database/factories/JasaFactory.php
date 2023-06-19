<?php

namespace Database\Factories;

use App\Models\Jasa;
use Illuminate\Database\Eloquent\Factories\Factory;

class JasaFactory extends Factory
{
    protected $model = Jasa::class;
    
    public function definition()
    {
        return [
            'Kode_Jasa' => $this->faker->unique()->numerify('KJ######'),
            'Nama_Perusahaan' => $this->faker->company,
            'Kota_Asal' => $this->faker->city,
            'Kota_Tujuan'=> $this->faker->city,
            'Harga' => $this->faker->randomNumber(5),
        ];
    }
}
