<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Todo::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
    ];
});