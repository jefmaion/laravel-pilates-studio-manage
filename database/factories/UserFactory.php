<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name = $this->faker->firstName();

        return [
            'name' => $name . ' ' . $this->faker->lastName(),
            'nickname' => $name,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),

            'gender' => $this->faker->randomElement(['M', 'F']),
            'phone' => $this->faker->phoneNumber(),
            'phone2' => $this->faker->phoneNumber(),
            'zipcode' => $this->faker->postcode(),
            'address' => $this->faker->address(),

            'birth_date' => $this->faker->date('Y-m-d', '2000-01-01'),
            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
