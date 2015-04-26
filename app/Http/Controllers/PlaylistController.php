<?php namespace App\Http\Controllers;

use App\Genre;
use App\Http\Requests;

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

        $playlists = Playlist::with('user', 'genre', 'songs')->search($query);

        if (Request::has('genre'))
        {
            $playlists->whereHas('genre', function ($q)
            {
                $parentGenre = Genre::where('name', Request::input('genre'))->firstOrFail();

                // Fetch all child genres as well as parent genre
                $genres = $parentGenre->getDescendantsAndSelf()->toArray();

                // Fetch only the genre name
                $genres = array_fetch($genres, 'name');

                $q->whereIn('name', $genres);
            });
        }

        $playlists = $playlists->simplePaginate(15);

        // Include the search term and genre in next page
        $playlists = $playlists->appends([
            'search' => Request::input('search'),
            'genre' => Request::input('genre'),
        ]);

        return view('playlists.index', compact('playlists'));
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
        $playlist = Playlist::findBySlugOrFail($slug);

        return view('playlists.show', compact('playlist'));
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

        return view('playlists.edit', compact('playlist'));
    }

    /**
     * Update a playlist
     *
     * @param string $slug Playlist slug
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

        Cache::forget('playlist_' . $slug);

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
        $forkedPlaylist = Playlist::findBySlugOrFail($slug);

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

        Cache::forever('playlist_' . $playlist->slug, $playlist);

        return redirect()->route('playlists.show', $playlist->slug);
    }

}
