<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'name': 'Introduction Javascript',
        //     'description': 'Learn the basics of Javascript',
        // ];
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
        ];
    }
}
