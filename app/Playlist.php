<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model {

	protected $table = 'playlists';

    public function songs()
    {
        return $this->hasMany('App\Song');
    }

    public function forkParent()
    {
        return $this->belongsTo('App\Playlist', 'fork_parent_id');
    }

    public function forks()
    {
        return $this->hasMany('App\Playlist', 'fork_parent_id');
    }

}
