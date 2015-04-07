<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model {

    protected $table = 'genres';

    public $timestamps = false;

    public function playlists()
    {
        return $this->belongsToMany('App\Playlist');
    }

    public function parentGenre()
    {
        return $this->belongsTo('App\Genre', 'parent_id');
    }

    public function subGenres()
    {
        return $this->hasMany('App\Genre', 'parent_id');
    }

}
