<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Status>
 */
class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement(['1', '2', '3', '4']),
            'content' => $this->faker->text(),
            'created_at' => $this->faker->dateTimeBetween('-1 month', '-1 day'),
            'updated_at' => $this->faker->dateTimeBetween('-1 day', '-1 hour'),
        ];
    }
}
