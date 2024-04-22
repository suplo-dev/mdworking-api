<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CampaignGoogle>
 */
class CampaignGoogleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 2,
            'name' => fake()->company(),
            'type' => 1,
            'started_at' => fake()->dateTimeBetween('-1 months'),
            'ended_at' => '2024-04-17',
        ];
    }
}
