<?php

Route::get('/', function ()
{
    return view('welcome');
});

Route::post('playlists/{slug}/fork', [
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
