<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Clients;
use Faker\Generator as Faker;

$factory->define(Clients::class, function (Faker $faker) {
    return [
        'f_name' => $faker->firstName(),
        'l_name' => $faker->lastName(),
        'email' => $faker->unique()->safeEmail,
        'password' => $faker->password(), // password
    ];
});
