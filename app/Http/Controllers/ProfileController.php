<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
		$user = User::findByNameOrFail($username);

        return view('users.view', [
            'user' => $user
        ]);
	}

}
