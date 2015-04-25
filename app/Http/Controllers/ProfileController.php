<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;

class ProfileController extends Controller {

    /**
     * Display a user's profile
     *
     * @param string $username
     *
     * @return \Illuminate\View\View
     */
    public function show($username)
    {
        $user = User::with('playlists.user', 'playlists.genre', 'playlists.songs')
            ->findByNameOrFail($username)
            ->firstOrFail();

        return view('users.show', compact('user'));
    }

}
