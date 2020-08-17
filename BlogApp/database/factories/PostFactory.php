<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        //
        'title' => Str::random(10),
        'body' => Str::random(10),
        'user_id' => 4,
    ];
});
