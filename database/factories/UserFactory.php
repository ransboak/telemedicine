<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $role = $this->faker->randomElement(array_merge(
            array_fill(0, 3, 'patient'),
            array_fill(0, 1, 'doctor')
        ));

        return [
            'name' => fake()->name(),
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'email' => fake()->email(),
            'contact' => fake()->numerify('0#########'),
            'password' => Hash::make('12345678'),
            'role' => $role,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
