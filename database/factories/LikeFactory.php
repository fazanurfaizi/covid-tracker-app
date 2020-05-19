<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Like;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {

    $likeable = [
        Post::class,
        Comment::class
    ];
    $likeableType = $faker->randomElement($likeable);
    $likeable = factory($likeableType)->create();

    return [
        'likeable_type' => $likeableType,
        'likeable_id' => $likeable->id,
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
    ];
});
