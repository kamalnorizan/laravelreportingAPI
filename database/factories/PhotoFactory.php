<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Photo;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'title'=>$this->faker->sentence(10),
        'path'=>$this->faker->word.'.jpg',
        'user_id'=>rand(1,50),
    ];
});
