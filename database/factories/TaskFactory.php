<?php

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $startDate = fake()->date();

        return [
            'subject' => fake()->sentence(),
            'description' => fake()->paragraph(2),
            'start_date' => $startDate,
            'end_date' => Carbon::parse($startDate)->addDays(fake()->randomNumber(1, true)),
            'status' => fake()->randomElement(array_column(TaskStatus::cases(), 'value')),
            'priority' => fake()->randomElement(array_column(TaskPriority::cases(), 'value')),
        ];
    }
}
