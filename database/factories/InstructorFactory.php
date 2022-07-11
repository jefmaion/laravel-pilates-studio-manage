<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'profession' => $this->faker->randomElement(['Fisioterapeuta', 'Educação Física']),
            'payment_type' => $this->faker->randomElement(['A', 'P']),
            'payment_value' => $this->faker->randomFloat(2, 10, 30)
        ];
    }
}
