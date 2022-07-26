<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'=>$this->faker->sentence(rand(7,12)),
        'content'=>$this->faker->paragraph(rand(5,10)),
        'user_id'=>rand(1,50)
    ];
});
