<?php

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'password' => bcrypt('secret'),
            'email' => $this->faker->unique()->safeEmail,
            'last_name' => $this->faker->lastName,
            'address' => $this->faker->address,
            'address2' => null,
            'zipcode' => $this->faker->postcode,
            'employee' => false,
            'theboss' => false,
            'remember_token' => Str::random(10),
            'phone_number' => $this->faker->phoneNumber,
            'confirmed' => $this->faker->boolean(50),
            'confirmation_token' => null
        ];
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'email' => 'l.neveux@icloud.com',
                'password' => bcrypt('admin'),
                'employee' => true,
                'theboss' => true
            ];
        });
    }

    public function employee()
    {
        return $this->state(function (array $attributes) {
            return [
                'email' => 'employee@restaurant.com',
                'password' => bcrypt('employee'),
                'employee' => true,
            ];
        });
    }
}
