<?php

namespace Database\Factories;

use App\Models\Order;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_type' => 'Delivery',
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'name' => $this->faker->name,
            'last_name' => $this->faker->lastName,
            'address' => $this->faker->address,
            'address2' => $this->faker->secondaryAddress,
            'zipcode' => $this->faker->postcode,
            'email' => $this->faker->safeEmail,
            'items' => '["{\"rowId\":\"dde9ecbd6fafe842eef36650588d573a\",\"id\":34,\"name\":\"Hamburger, The only one\",\"qty\":1,\"price\":15.55,\"weight\":0,\"options\":{\"options\":{\"options\":[],\"way\":\"Medium Rare\"}},\"discount\":0,\"tax\":1.56,\"subtotal\":15.55}","{\"rowId\":\"b061c180291d38c14410ec09e58b8212\",\"id\":39,\"name\":\"Roasted Chicken\",\"qty\":1,\"price\":21.25,\"weight\":0,\"options\":{\"options\":{\"options\":[],\"way\":null}},\"discount\":0,\"tax\":2.13,\"subtotal\":21.25}"]',
            'price' => $this->faker->randomNumber(4),
            'phone_number' => $this->faker->phoneNumber,
            'taxes' => 1
        ];
    }

    public function hidden()
    {
        return $this->state(function (array $attributes) {
            return [
                'hideable_id' => 999,
                'hideable_type' => 'App\Models\Order'
            ];
        });
    }

    public function pickup()
    {
        return $this->state(function (array $attributes) {
            return [
                'order_type' => 'Pick-up',
            ];
        });
    }
}
