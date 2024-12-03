<?php

namespace Database\Factories;

use App\Models\Dokumentasi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DokumentasiFactory extends Factory
{
    protected $model = Dokumentasi::class;

    public function definition()
    {
        return [
			'keterangan' => $this->faker->name,
			'gambar_penyerahan' => $this->faker->name,
			'pdf_laporan' => $this->faker->name,
        ];
    }
}
