<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GameScores>
 */
class GameScoresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date_interval = $this->faker->randomElement(['03-2025','02-2025','04-2025']);
        return [
            'user_id' => User::factory(),
            'score' => $this->faker->numberBetween(1,100),
            'date_interval' => $date_interval,
            'active' => 1,

        ];
    }
}
