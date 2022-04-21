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
            'longtitude' => $this->faker->longitude(),
            'location' => $this->faker->address(),
            'opening_hours' => $this->faker->time(),
            'closed_hours' => $this->faker->time(),
        ];
    }
}
