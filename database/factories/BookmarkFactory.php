<?php

use Faker\Generator as Faker;

$factory->define(App\Bookmark::class, function (Faker $faker) {
	$content = factory(App\Content::class)->create();

    return [
        'user_id' => factory(App\User::class)->create()->id,
        'post_id' => $content->post->id,
        'content_id' => $content->id
    ];
});
