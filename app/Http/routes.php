<?php

Route::get('/', function ()
{
    return view('welcome');
});

Route::get('playlists/{id}/songs', 'PlaylistController@songs');

Route::get('playlists/{id}/fork', [
    'uses' => 'PlaylistController@fork',
    'as'   => 'playlists.fork'
]);

Route::resource('playlists', 'PlaylistController', [
    'except' => [
        'edit'
    ]
]);

Route::controllers([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
