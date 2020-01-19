<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(\App\DAO\Board::class, function (Faker $faker) {
    return [
        "contents"   => Str::random(10),
        "subject"    => Str::random(10),
        "email"      => Str::random(10) . '@gmail.com',
        "user_seq"   => rand("1","1000"),
        "user_name"  => Str::random(10),
        "nick_name"  => Str::random(10),
        "user_id"    => Str::random(10),
        "visitor"    => Str::random(10),
        "created_at" => date("Y-m-d H:i:s"),
    ];
});
