<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content'=>$this->faker->sentence(rand(7,12)),
        'user_id'=>rand(1,50),
        'post_id'=>rand(1,200),
    ];
});
