<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function()
{
    return view('welcome');
});

Route::get('playlists/{id}/songs', 'PlaylistController@songs');

Route::get('playlists/{id}/fork', [
    'uses' => 'PlaylistController@fork',
    'as'   => 'playlists.fork'
]);

Route::resource('playlists', 'PlaylistController');

Route::controllers([
	'auth'     => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
