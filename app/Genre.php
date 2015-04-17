<?php namespace App;

use Baum\Node;

class Genre extends Node {

    protected $table = 'genres';

    public $timestamps = false;

    /**
     * Find playlists
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function playlists()
    {
        return $this->belongsToMany('App\Playlist');
    }

    /**
     * Find the parent genre
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentGenre()
    {
        return $this->belongsTo('App\Genre', 'parent_id');
    }

    /**
     * Find sub genres
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subGenres()
    {
        return $this->hasMany('App\Genre', 'parent_id');
    }

}
