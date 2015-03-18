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

        return redirect()->route('playlists.show', [$playlist]);
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

    /**
     * Gets the songs for the given playlist
     *
     * @param int $id Playlist ID
     *
     * @return array
     */
    public function songs($id)
    {
        $playlist = Playlist::findOrFail($id);

        return $playlist->songs->toArray();
    }

    /**
     * Forks a given playlist and associates it with the current user
     *
     * @param int $id Playlist ID
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fork($id)
    {
        $forkedPlaylist = Playlist::findOrFail($id);

        $playlist = $forkedPlaylist->replicate();

        $playlist->forkParent()->associate($forkedPlaylist);
        $playlist->user()->associate(Auth::user());

        $playlist->save();

        foreach ($forkedPlaylist->songs as $forkedSong)
        {
            $song = $forkedSong->replicate();

            $song->playlist()->associate($playlist);

            $song->save();
        }

        return redirect()->route('playlists.show', [$playlist]);
    }

}