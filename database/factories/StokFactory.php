<?php

namespace Database\Factories;

use App\Models\Stok;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StokFactory extends Factory
{
    protected $model = Stok::class;

    public function definition()
    {
        return [
			'barang_id' => $this->faker->name,
			'satuan_id' => $this->faker->name,
			'jumlah_masuk' => $this->faker->name,
			'tgl_masuk' => $this->faker->name,
			'harga_satuan' => $this->faker->name,
			'total_harga' => $this->faker->name,
        ];
    }
}
