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
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->name();
        $username = strtolower(str_replace(' ', '', $name));

        return [
            'idrole' => fake()->unique()->randomElement([1,2,3]),
            'name' => $name,
            'username' => $username,
            'password' => bcrypt('12345'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
