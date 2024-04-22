<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdsGoogle>
 */
class AdsGoogleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'campaign_id' => 1,
            'name' => fake()->company(),
            'click' => fake()->numberBetween(10, 100),
            'ctr' => fake()->numberBetween(10, 100),
            'avg_cpc' => fake()->numberBetween(10, 100),
            'amount_spent' => fake()->numberBetween(100000, 1000000),
            'started_at' => fake()->dateTimeBetween('-1 months'),
            'ended_at' => Carbon::yesterday(),
        ];
    }
}
