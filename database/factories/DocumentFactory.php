<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Document;
use Faker\Generator as Faker;

$factory->define(Document::class, function (Faker $faker) {
    return [
        'loan_id' => 1,
        'name' => $faker->word,
        'file_name' => \Illuminate\Support\Str::uuid(),
    ];
});
