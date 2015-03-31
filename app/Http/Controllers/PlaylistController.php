<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Playlist;
use App\Http\Requests\PlaylistRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class PlaylistController extends Controller {

    public function __construct()
    {
        $this->middleware('auth', [
            'except' => [
                'index',
                'show',
                'songs'
            ]
        ]);
    }

    /**
     * Display list of all playlists
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Request::flash();

        if (Request::has('search'))
        {
            $search = Request::input('search');
            $playlists = Playlist::where('name', 'like', "%$search%")
                                 ->paginate(15);
        }
        else
        {
            $playlists = Playlist::paginate(15);
        }

        return view('playlists.index', [
            'playlists' => $playlists
        ]);
    }

    /**
     * Display form for creating a new playlist
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('playlists.create');
    }

    /**
     * Create a new playlist
     *
     * @param PlaylistRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PlaylistRequest $request)
    {
        $playlist = new Playlist;

        $playlist->name = $request->input('name');
        $playlist->user()
                 ->associate(Auth::user());

        $playlist->save();

        return redirect()->route('playlists.show', $playlist->slug);
    }

    /**
     * Show a playlist
     *
     * @param string $slug Playlist slug
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $playlist = Playlist::findBySlugOrFail($slug);

        return view('playlists.show', [
            'playlist' => $playlist
        ]);
    }

    /**
     * Update a playlist
     *
     * @param string          $slug Playlist slug
     * @param PlaylistRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($slug, PlaylistRequest $request)
    {
        $playlist = Auth::user()
                        ->playlists()
                        ->findBySlugOrFail($slug);

        $playlist->name = $request->input('name');

        $playlist->save();

        return redirect()->route('playlists.show', $playlist->slug);
    }

    /**
     * Delete a playlist
     *
     * @param string $slug Playlist slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $playlist = Auth::user()
                        ->playlists()
                        ->findBySlugOrFail($slug);

        $playlist->delete();

        Session::flash('message', 'Playlist successfully deleted!');

        return redirect()->route('playlists.index');
    }

    /**
     * Get the songs for the given playlist
     *
     * @param string $slug Playlist slug
     *
     * @return array
     */
    public function songs($slug)
    {
        $playlist = Playlist::findBySlugOrFail($slug);

        return $playlist->songs->toArray();
    }

    /**
     * Fork a given playlist and associate it with the current user
     *
     * @param string $slug Playlist slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fork($slug)
    {
        $forkedPlaylist = Playlist::findBySlugOrFail($slug);

        $playlist = $forkedPlaylist->replicate()
                                   ->resluggify();

        $playlist->forkParent()
                 ->associate($forkedPlaylist);
        $playlist->user()
                 ->associate(Auth::user());

        $playlist->save();

        foreach ($forkedPlaylist->songs as $forkedSong)
        {
            $song = $forkedSong->replicate();

            $song->playlist()
                 ->associate($playlist);

            $song->save();
        }

        return redirect()->route('playlists.show', $playlist->slug);
    }

}
