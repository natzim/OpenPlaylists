<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model {

    protected $table = 'songs';

    public $timestamps = false;

    /**
     * Find playlists that contain song
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function playlists()
    {
        return $this->belongsToMany('App\Playlist');
    }

}
