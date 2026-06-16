<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Link>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'profile_id' => Profile::factory(),
            'title' => fake()->words(2, true),
            'url' => fake()->url(),
            'icon' => fake()->randomElement(['link', 'globe', 'social']),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
