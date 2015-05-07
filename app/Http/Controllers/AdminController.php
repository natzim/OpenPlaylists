<?php namespace App\Http\Controllers;

use App\Playlist;
use App\User;

class AdminController extends Controller {

    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function dashboard()
    {
        $playlists = Playlist::orderBy('created_at', 'desc')->take(10)->get();
        $users = User::orderBy('created_at', 'desc')->take(10)->get();

        return view('admin.dashboard', compact('playlists', 'users'));
    }

}
