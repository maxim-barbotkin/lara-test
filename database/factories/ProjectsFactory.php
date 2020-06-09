<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Projects;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Projects::class, function (Faker $faker) {
    return [
        'name' => Str::random(10),
        'description' => Str::random(50),
        'status' => $faker->randomElement([
            'planned',
            'running',
            'on hold',
            'finished',
            'cancel'
        ]),
    ];
});
