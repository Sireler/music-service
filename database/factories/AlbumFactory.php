<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Album;
use App\Artist;
use Faker\Generator as Faker;

$factory->define(Album::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'artist_id' => function() {
            return factory(Artist::class)->create()->id;
        }
    ];
});
