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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {
    /** Auth routes */
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::middleware('auth:api')->post('/logout', 'AuthController@logout');


    /** Song */
    Route::get('/songs', 'API\SongController@all');
    Route::get('/song/{id}', 'API\SongController@song');
    Route::post('/song/create', 'API\SongController@create');

    /** Artist */
    Route::post('/artist/create', 'API\ArtistController@create');

});

