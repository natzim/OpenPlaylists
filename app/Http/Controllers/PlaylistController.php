<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Playlist;
use App\Http\Requests\PlaylistRequest;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller {

    /**
     * Display list of all playlists
     *
     * @return \Illuminate\View\View
     */
	public function index()
	{
		return view('playlists.index', [
            'playlists' => Playlist::all()
        ]);
	}

    /**
     * Display form for creating new playlists
     *
     * @return \Illuminate\View\View
     */
	public function create()
	{
		return view('playlists.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PlaylistRequest $request)
	{
		$playlist = new Playlist;

        $playlist->name = $request->input('name');
        $playlist->user()->associate(Auth::user());

        $playlist->save();

        return redirect('/');
	}

    /**
     * Show a playlist
     *
     * @param int $id Playlist ID
     *
     * @return \Illuminate\View\View
     */
	public function show($id)
	{
        $playlist = Playlist::findOrFail($id);

		return view('playlists.show', [
            'playlist' => $playlist
        ]);
	}

    /**
     * Show form for editing a playlist
     *
     * @param int $id Playlist ID
     *
     * @return \Illuminate\View\View
     */
	public function edit($id)
	{
        $playlist = Playlist::findOrFail($id);

        return view('playlists.edit', [
            'playlist' => $playlist
        ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
