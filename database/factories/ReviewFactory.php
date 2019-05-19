<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        "product_id"=>function(){

           return \App\Product::all()->random();

        },
        "user_id"=>function(){

            return \App\User::all()->random();

        },
        "review"=>$faker->paragraph,
        "star"=>$faker->numberBetween(0,5),

    ];
});
