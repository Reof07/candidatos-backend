<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'source' => fake()->randomElement(['Fotocasa', 'Habitaclia']),
            'owner' => User::all()->random()->id,
            'created_by' => User::all()->random()->id,
        ];
    }
}
