<?php

use Faker\Generator as Faker;

$factory->define(App\Car::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'brand'=> $faker->randomElement(["Skoda","Ford","BMW","Fiat"]),
        'model'=> $faker->text(7),
        'image'=> $faker->text(7),
        'description'=> $faker->text(100),
        'productionyear'=> $faker->randomElement([2017,2015,2013,2011]),
        'rented'=> $faker->boolean('false'),
    ];
});
