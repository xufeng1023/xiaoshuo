<?php

use Faker\Generator as Faker;

$factory->define(App\Content::class, function (Faker $faker) {
	$post = factory(App\Post::class)->create();
    return [
    	'post_id' => $post->id,
        'content' => $faker->text
    ];
});
