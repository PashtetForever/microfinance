<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserVerify;
use Faker\Generator as Faker;

$factory->define(UserVerify::class, function (Faker $faker) {
    return [
        'code' => rand(111111, 999999),
        'phone' => $faker->phoneNumber
    ];
});
