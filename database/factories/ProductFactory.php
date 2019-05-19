<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        "name"=> $faker->word,
        "detail"=>$faker->paragraph,
         "price"=>$faker->numberBetween(100,10000),
          "quantity"=>$faker->randomDigit,
          "discount"=>$faker->numberBetween(5,50),
          "image"=>$faker->imageUrl(),
         "seller_id"=>function(){

            return \App\User::all()->random();

        },
    ];
});
