<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Playlist;
use App\Http\Requests\PlaylistRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Request::flash();

        $query = Request::input('search');

        $playlists = Playlist::with('genre', 'songs', 'user')->search($query);

        if (Request::has('genre'))
        {
            $playlists->whereHas('genre', function ($q)
            {
                $genre = Request::input('genre');

                $q->where('name', $genre);
            });
        }

        return view('playlists.index', [
            'playlists' => $playlists->paginate(15)
        ]);
    }

    /**
     * Display form for creating a new playlist
     *
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
        $playlist->user()->associate(Auth::user());

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
        if (Cache::has("playlist_$slug"))
        {
            $playlist = Cache::get("playlist_$slug");
        }
        else
        {
            $playlist = Playlist::with('songs', 'forkParent', 'genre')->findBySlugOrFail($slug);

            Cache::forever("playlist_$slug", $playlist);
        }

        return view('playlists.show', [
            'playlist' => $playlist
        ]);
    }

    /**
     * Display form for editing playlist
     *
     * @param string $slug Playlist slug
     *
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $playlist = Auth::user()
            ->playlists()
            ->findBySlugOrFail($slug);

        return view('playlists.edit', [
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

        dd($request->input('songs'));

        $playlist->name = $request->input('name');

        $playlist->resluggify();

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

        Cache::forget("playlist_$slug");

        $playlist->delete();

        Session::flash('message', 'Playlist successfully deleted!');

        return redirect()->route('playlists.index');
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
        if (Cache::has("playlist_$slug"))
        {
            $forkedPlaylist = Cache::get("playlist_$slug");
        }
        else
        {
            $forkedPlaylist = Playlist::with('songs')->findBySlugOrFail($slug);
        }

        $playlist = $forkedPlaylist->replicate();

        $playlist->forkParent()->associate($forkedPlaylist);
        $playlist->user()->associate(Auth::user());

        // Generate a new slug for the playlist to avoid duplicates
        $playlist->resluggify();

        $playlist->save();

        // Replicate songs after playlist saved to allow for foreign key in pivot table
        foreach ($forkedPlaylist->songs as $song)
        {
            $playlist->songs()->save($song);
        }

        Cache::forever("playlist_$playlist->slug", $playlist);

        return redirect()->route('playlists.show', $playlist->slug);
    }

}
