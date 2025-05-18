<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement(['video', 'document', 'slides', 'photo']),
            'link' => $this->faker->url(),
            'user_id' => 3,
            'unit_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
