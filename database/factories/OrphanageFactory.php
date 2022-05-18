<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orphanage>
 */
class OrphanageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'province_id' => 35,
            'regency_id' => 3511,
            'district_id' => 3511050,
            'address' => $this->faker->address(),
            'opening_hours' => $this->faker->time('H:i'),
            'closing_hours' => $this->faker->time('H:i'),
        ];
    }
}
