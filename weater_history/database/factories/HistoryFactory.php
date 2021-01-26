<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\HistoryModel;
use Faker\Generator as Faker;

$factory->define(HistoryModel::class, function (Faker $faker) {
    return [
        'temp' => $faker->randomFloat(2, -50, 50),
        'date_at' => $faker->unique()->dateTimeBetween('-6 months')->format('Y-m-d'),
    ];
});
