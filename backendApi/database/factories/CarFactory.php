<?php

use Faker\Generator as Faker;

$factory->define(App\Car::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'brand'=> $faker->text(7),
        'model'=> $faker->text(7),
        'description'=> $faker->text(100),
        'rented'=> $faker->boolean('false'),
        'renter'=> $faker->randomElement(['','']),
    ];
});
