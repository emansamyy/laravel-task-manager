<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->sentence(),
            'description' => fake()->unique()->paragraph(),
            'priority' => fake()->numberBetween(1, 5),
            'due_date' => fake()->dateTime(),
            'project_id' => fake()->numberBetween(1, Project::count()),
        ];
    }
}
