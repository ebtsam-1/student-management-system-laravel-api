<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\School>
 */
class SchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'user_id' => $user->id,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (School $school) {
            // dd($school);
        });
    }
}
