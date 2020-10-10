<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\OptionGroup;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'holiday_special' => false,
            'today' => false,
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            },
            'type' => $this->faker->word,
            'slug' => $this->faker->domainWord,
            'description' => $this->faker->text,
            'price' => $this->faker->randomNumber(4),
//            'image' => $this->faker->image('public/img'), // If need Images
            'image' => 'public/img/img.jpg',

        ];
    }

    public function hidden()
    {
        return $this->state(function (array $attributes) {
            return [
                'hideable_id' => 999,
                'hideable_type' => 'App\Models\Product',
            ];
        });
    }

    public function todaySpecial()
    {
        return $this->state(function (array $attributes) {
            return [
                'today' => true,
            ];
        });
    }

    public function holidaySpecial()
    {
        return $this->state(function (array $attributes) {
            return [
                'holiday_special' => true,
            ];
        });
    }
}
