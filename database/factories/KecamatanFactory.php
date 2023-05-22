<?php

namespace Database\Factories;

use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class KecamatanFactory extends Factory
{
    protected $model = Kecamatan::class;

    public function definition()
    {
        return [
			'kode_kecamatan' => $this->faker->name,
			'nama_kecamatan' => $this->faker->name,
			'luas_wilayah' => $this->faker->name,
			'jumlah_penduduk' => $this->faker->name,
        ];
    }
}
