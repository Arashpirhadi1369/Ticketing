<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(31, 35),
            'subject' => $this->faker->realText(20),
            'content' => $this->faker->realText(),
            'status_id' => $this->faker->numberBetween(1, 1),
        ];
    }
}
