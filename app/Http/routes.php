<?php

/*
 * Home page
 */

get('/', function ()
{
    return view('welcome');
});

/*
 * Playlists
 */

post('playlists/{slug}/fork', [
    'uses' => 'PlaylistController@fork',
    'as' => 'playlists.fork'
]);

resource('playlists', 'PlaylistController');

/*
 * Profiles
 */

get('user/{name}', [
    'uses' => 'ProfileController@show',
    'as' => 'users.show'
]);

/*
 * API
 */

Route::group(['prefix' => 'api'], function ()
{
    get('genres', 'GenreController@index');
});

/*
 * Authentication
 */

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
