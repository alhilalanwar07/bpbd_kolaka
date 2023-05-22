<?php

namespace Database\Factories;

use App\Models\Bencana;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BencanaFactory extends Factory
{
    protected $model = Bencana::class;

    public function definition()
    {
        return [
			'nama_bencana' => $this->faker->name,
			'deskripsi_bencana' => $this->faker->name,
        ];
    }
}
