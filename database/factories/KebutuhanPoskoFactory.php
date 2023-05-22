<?php

namespace Database\Factories;

use App\Models\KebutuhanPosko;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class KebutuhanPoskoFactory extends Factory
{
    protected $model = KebutuhanPosko::class;

    public function definition()
    {
        return [
			'posko_id' => $this->faker->name,
			'barang_id' => $this->faker->name,
			'jumlah_kebutuhan' => $this->faker->name,
			'jenis_kebutuhan' => $this->faker->name,
			'status_kebutuhan' => $this->faker->name,
        ];
    }
}
