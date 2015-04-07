<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Playlist extends Model implements SluggableInterface {

    use SluggableTrait;
    use SearchableTrait;
    use SoftDeletes;

    protected $table = 'playlists';

    protected $sluggable = [];

    protected $searchable = [
        'columns' => [
            'name' => 10
        ]
    ];

    /**
     * Get a playlist from slug
     *
     * @param $query
     * @param $slug
     *
     * @return \App\Playlist
     */
    public function scopeFindBySlugOrFail($query, $slug)
    {
        return $query->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * Is the playlist a fork of another playlist?
     *
     * @return bool
     */
    public function isFork()
    {
        return !is_null($this->forkParent);
    }

    /**
     * Has the playlist been updated?
     *
     * @return bool
     */
    public function hasBeenUpdated()
    {
        return $this->updated_at > $this->created_at;
    }

    public function songs()
    {
        return $this->belongsToMany('App\Song');
    }

    public function forkParent()
    {
        return $this->belongsTo('App\Playlist', 'fork_parent_id');
    }

    public function forks()
    {
        return $this->hasMany('App\Playlist', 'fork_parent_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
