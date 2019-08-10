<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function() {
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    /** Auth routes */
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::middleware('auth:api')->post('/logout', 'AuthController@logout');


    /** Song */
    Route::get('/songs', 'API\SongController@index');
    Route::get('/song/{id}', 'API\SongController@show');
    Route::post('/song/create', 'API\SongController@create');
    Route::post('/songs/upload', 'API\SongController@upload');


    /** Artist */
    Route::get('/artists', 'API\ArtistController@index');
    Route::get('/artists/{id}', 'API\ArtistController@show');
    Route::get('/artists/{id}/songs', 'API\ArtistController@songs');
    Route::get('/artists/{id}/albums', 'API\ArtistController@albums');
    Route::post('/artist/create', 'API\ArtistController@create');
    Route::post('/artists/{id}/update/avatar', 'API\ArtistController@updateAvatar');

    /** Albums */
    Route::get('/albums', 'API\AlbumController@index');
    Route::get('/albums/{id}', 'API\AlbumController@show');
    Route::get('/albums/{id}/tracks', 'API\AlbumController@tracks');
});

