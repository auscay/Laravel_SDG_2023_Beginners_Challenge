<?php
// File: database/factories/TaskFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


// use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'dueDate' => fake()->date(),
            'status' => fake()->randomElement(['pending', 'in_progress', 'completed']),
        ];
    }
}
