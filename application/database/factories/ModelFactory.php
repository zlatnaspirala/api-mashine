<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

/** @var EloquentFactory $factory */

/** User */
$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

/** Avatar - user photo */
$factory->define(App\Avatar::class, function (Faker $faker) {

    return [
        'path' => 'avatars/' . Str::random(6) . '.jpg',
        'media_type' => 'image/jpeg',
        'user_id' => function () {
            return factory(App\User::class)->create()->getKey();
        },
    ];

});

/** Post */
$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'slug' => $faker->slug(),
        'content' => $faker->paragraphs(3, true),
        'published_at' => $faker->dateTime,
        'author_id' => function () {
            return factory(App\User::class)->create()->getKey();
        },
    ];
});

/** Comment */
$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'post_id' => function () {
            return factory(App\Post::class)->create()->getKey();
        },
        'user_id' => function () {
            return factory(App\User::class)->create()->getKey();
        },
    ];
});

/** Tag */
$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
    ];
});

/** Gameplay */
$factory->define(App\Gameplay::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'channelid' => $faker->slug(),
        'content' => $faker->paragraphs(3, true),
        'published_at' => $faker->dateTime,
        'author_id' => function () {
            return factory(App\User::class)->create()->getKey();
        },
    ];
});
