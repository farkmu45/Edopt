<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'text_preview' => $this->faker->sentence(6),
            'content' => $this->faker->paragraphs(4, true),
            'admin_id' => $this->faker->numberBetween(1, 9)
        ];
    }
}
