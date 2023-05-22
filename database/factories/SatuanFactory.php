<?php

namespace Database\Factories;

use App\Models\Satuan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SatuanFactory extends Factory
{
    protected $model = Satuan::class;

    public function definition()
    {
        return [
			'nama_satuan' => $this->faker->name,
        ];
    }
}
