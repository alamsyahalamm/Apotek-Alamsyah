<?php

namespace Database\Factories;

use App\Models\Obat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObatFactory extends Factory
{

    protected $model = Obat::class;

    public function definition()
    {
        $daftar_gambar = [
            "Jowy.jpeg",
            "Riou.jpeg",
            "Nanami.jpeg",
        ];

        return [
            'Kode_Obat' => $this->faker->unique()->numerify('KO######'),
            'Nama_Obat' => $this->faker->name,
            'Bentuk_Obat' => $this->faker->word,
            'Hargas' => $this->faker->randomNumber(5),
            'Tgl_Masuk' => $this->faker->date(),
            'Tgl_Kadaluarsa' => $this->faker->date(),
            'Indikasi' => $this->faker->text,
            'Kontra_Indikasi' => $this->faker->text,
            'Aturan' => $this->faker->text,
            'Stok' => $this->faker->numberBetween(50, 200),
            // 'Gambar' => $this->faker->imageUrl(640, 480, 'animals', true),
            'Gambar' => $this->faker->randomElement($daftar_gambar),
        ];
    }
}
