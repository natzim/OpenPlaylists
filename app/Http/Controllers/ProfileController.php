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
        // Eager loading doesn't work here for some reason
        $user = User::findByNameOrFail($username);

        return view('users.show', compact('user'));
    }

}
