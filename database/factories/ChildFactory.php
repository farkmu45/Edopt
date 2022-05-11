<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Child>
 */
class ChildFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'gender' => 'MALE',
            'age' => $this->faker->numberBetween(5, 20),
            'additional_info' => $this->faker->sentences(10, true),
            'is_adopted' => $this->faker->boolean(),
            'orphanage_id' => $this->faker->numberBetween(1, 9)
        ];
    }
}
