<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => fake()->sentence(),
            'attachments' => array_map(function() {
                return "attachments/" . basename($this->faker->image(Storage::path('attachments/')));
            }, range(1, 3)),
            'note' => fake()->paragraph(2),
        ];
    }
}
