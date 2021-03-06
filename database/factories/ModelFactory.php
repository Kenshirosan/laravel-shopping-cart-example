<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    $address = $faker->address;
    $address2 = null;
    $zipcode = 13001;
    $name = $faker->name;
    $email = $faker->unique()->safeEmail;
    $price = $faker->numberBetween($min = 2500, $max = 35000);
    $phone = $faker->phoneNumber;

    return [
        'name' => $name,
        'password' => $password ?: $password = bcrypt('secret'),
        'email' => $email,
        'last_name' => $name,
        'address' => $address,
        'address2' => null,
        'zipcode' => 13001,
        'employee' => false,
        'theboss' => false,
        'remember_token' => str_random(10),
        'phone_number' => $faker->phoneNumber,
        'confirmed' => true,
        'confirmation_token' => null
    ];
});

$factory->state(App\User::class, 'administrator', function() {
    return [
        'employee' => true,
        'theboss' => true
    ];
});

$factory->state(App\User::class, 'employee', function() {
    return [
        'employee' => true
    ];
});



$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    $price = $faker->numberBetween($min = 2500, $max = 35000);
    return [
        'name' => $faker->name,
        'holiday_special' => 0,
        'option_group_id' => 999,
        'category_id' => 999,
        'category' => 'Appetizers',
        'slug' => $faker->name,
        'description' => $faker->text,
        'price' => $price,
        'image' => $faker->file
    ];
});

$factory->define(App\Models\Order::class, function ($faker) {
    $address = $faker->address;
    $address2 = null;
    $zipcode = 10001;
    $name = $faker->name;
    $email = $faker->unique()->safeEmail;
    $price = $faker->numberBetween($min = 2500, $max = 35000);
    $phone = $faker->phoneNumber;

    return [
        'id' => 999,
        'user_id' => $faker->numberBetween($min = 2, $max = 100),
        'name' => $faker->name,
        'last_name' => $faker->name,
        'address' => $address,
        'address2' => $address2,
        'zipcode' => $zipcode,
        'email' => $email,
        'items' => 'toto',
        'price' => $price,
        'phone_number' => $phone,
        'taxes' => 1
    ];
});
