<?php

namespace Database\Factories;

use App\Models\Posko;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PoskoFactory extends Factory
{
    protected $model = Posko::class;

    public function definition()
    {
        return [
			'nama_posko' => $this->faker->name,
			'nama_petugas' => $this->faker->name,
			'alamat_posko' => $this->faker->name,
			'no_hp' => $this->faker->name,
			'latitude' => $this->faker->name,
			'longitude' => $this->faker->name,
			'jumlah_pengungsi' => $this->faker->name,
			'status_posko' => $this->faker->name,
			'bencana_id' => $this->faker->name,
			'kecamatan_id' => $this->faker->name,
			'user_id' => $this->faker->name,
        ];
    }
}
