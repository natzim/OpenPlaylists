<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model {

    protected $table = 'songs';

    public $timestamps = false;

    public function playlists()
    {
        return $this->belongsToMany('App\Playlist');
    }

}
