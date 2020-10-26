<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EmailVerify;
use Faker\Generator as Faker;

$factory->define(EmailVerify::class, function (Faker $faker) {
    return [
        'user_guid' => $faker->uuid,
        'code' => rand(1111, 9999),
        'email' => $faker->email
    ];
});
