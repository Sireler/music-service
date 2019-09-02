<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Album;
use App\Song;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Song::class, function (Faker $faker) {
    return [
        'id' => Str::random(),
        'album_id' => function() {
            return factory(Album::class)->create()->id;
        },
        'title' => $faker->title,
        'length' => $faker->randomFloat(2, 50, 200),
        'path' => '',
        'cover' => ''
    ];
});
