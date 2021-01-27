<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\HistoryModel;
use Faker\Generator as Faker;

use Illuminate\Support\Carbon;


$ddd = Carbon::parse('2020-07-01');

$factory->define(HistoryModel::class, function (Faker $faker) use ($ddd) {
    $ddd->addDay();

    return [
        'temp' => $faker->randomFloat(2, -50, 50),
        'date_at' => $ddd->toDateString()
    ];
});
