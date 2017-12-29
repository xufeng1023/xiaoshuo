<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'author' => $faker->name,
        'content' => $faker->text
    ];
});
