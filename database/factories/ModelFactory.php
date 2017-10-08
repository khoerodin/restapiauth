<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker $faker) {
    static $password;
    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'avatar'         => 'https://randomuser.me/api/portraits/' . $faker->randomElement(['men', 'women']) . '/' . rand(1, 99) . '.jpg',
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Channel::class, function (Faker $faker) {
    return [
        'name'    => $faker->company,
        'logo'    => $faker->imageUrl(60, 60),
        'cover'   => $faker->imageUrl(),
        'about'   => $faker->text(rand(100, 500)),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});

$factory->define(App\Video::class, function (Faker $faker) {
    return [
        'title'          => ucfirst($faker->words(rand(5, 20), true)),
        'description'    => $faker->realText(rand(80, 600)),
        'published'      => $faker->boolean(),
        'url'            => $faker->url,
        'thumbnail'      => $faker->imageUrl(640, 480, null, true),
        'allow_comments' => $faker->boolean(80),
        'views'          => $faker->randomDigit,
        'user_id'        => function () {
            return App\User::inRandomOrder()->first()->id;
        },
    ];
});

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'body'     => $faker->realText(rand(10, 200)),
        'video_id' => function () {
            return App\Video::inRandomOrder()->first()->id;
        },
        'user_id'  => function () {
            return App\User::inRandomOrder()->first()->id;
        },
    ];
});
