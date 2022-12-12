<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tutor>
 */
class TutorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'lastName' => $this->faker->lastName(),
            'DNI' => $this->faker->dni(),
            'date_birth' => $this->faker->date('d-m-Y','30-12-16'),
            'gender' => $this->faker->randomElement(['masculino', 'femenino', 'no binario']),
            'andress' => $this->faker->streetAddress(),
            'country' => $this->faker->country(),
            'phone_number' => $this->faker->e164PhoneNumber(),
            'house_phone_number' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->email(),
        ];
    }
}
