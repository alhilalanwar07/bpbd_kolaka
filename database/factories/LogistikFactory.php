<?php

namespace Database\Factories;

use App\Models\Logistik;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LogistikFactory extends Factory
{
    protected $model = Logistik::class;

    public function definition()
    {
        return [
			'barang_id' => $this->faker->name,
			'satuan_id' => $this->faker->name,
			'jumlah_barang' => $this->faker->name,
			'harga_satuan' => $this->faker->name,
			'total_harga' => $this->faker->name,
        ];
    }
}
