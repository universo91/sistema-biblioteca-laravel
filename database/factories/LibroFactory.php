<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'titulo'=> $faker->name,
        'isbn' => $faker->unique()->isbn13,
        'autor' => $faker->name,
        'cantidad' => $faker->randomDigitNotNull * 7,
        'editorial' => $faker->company,
        'foto' => $faker->imageUrl(640,480),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
