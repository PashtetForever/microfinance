<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Loan;
use Faker\Generator as Faker;

$factory->define(Loan::class, function (Faker $faker) {
    return [
        'loan_id' => '№ ' . $faker->numberBetween(0, 1000),
        'user_guid' => \Illuminate\Support\Str::uuid(),
        'loan_guid' => \Illuminate\Support\Str::uuid(),
    ];
});
