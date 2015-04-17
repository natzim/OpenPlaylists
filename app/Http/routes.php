<?php

/*
 * Home page
 */

Route::get('/', function ()
{
    return view('welcome');
});

/*
 * Playlists
 */

Route::post('playlists/{slug}/fork', [
    'uses' => 'PlaylistController@fork',
    'as' => 'playlists.fork'
]);

Route::resource('playlists', 'PlaylistController');

/*
 * Profiles
 */

Route::get('user/{name}', [
    'uses' => 'ProfileController@show',
    'as'   => 'users.show'
]);

/*
 * API
 */

Route::group(['prefix' => 'api'], function ()
{
    Route::get('genres', 'GenreController@index');
});

/*
 * Authentication
 */

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
