<?php

namespace Database\Factories;

use App\Models\SortOrdersByTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class SortOrdersByTimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SortOrdersByTime::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'time' => $this->faker->time('H:i:s'),
            'date' => $this->faker->dateTimeBetween('2018-01-01', 'today'),
            'day' => $this->faker->dayOfWeek()
        ];
    }

    public function pickUp()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'Pick-up',
            ];
        });
    }

    public function breakfast()
    {
        return $this->state(function (array $attributes) {
            return [
                'moment' => 'Breakfast',
            ];
        });
    }

    public function lunch()
    {
        return $this->state(function (array $attributes) {
            return [
                'moment' => 'Lunch',
            ];
        });
    }

    public function dinner()
    {
        return $this->state(function (array $attributes) {
            return [
                'moment' => 'Dinner',
            ];
        });
    }
}
