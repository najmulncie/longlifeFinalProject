<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EmergencyAlert;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmergencyAlert>
 */
class EmergencyAlertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->fake()->sentence,
            'description' => $this->fake()->paragraph,
            'location' => $this->fake()->address,
            'alert_time' => $this->fake()->dateTime(),
            'category' => $this->fake()->randomElement(['natural_disaster', 'criminal_activity', 'health_emergency']),
            'severity' => $this->fake()->randomElement(['low', 'medium', 'high']),
            'source' => $this->fake()->company,
        ];
    }
}
