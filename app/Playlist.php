<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * App\Playlist
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Song[] $songs
 * @property-read \App\Playlist $forkParent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Playlist[] $forks
 * @property integer $id
 * @property integer $user_id
 * @property integer $forked_playlist_id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Playlist whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Playlist whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Playlist whereForkedPlaylistId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Playlist whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Playlist whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Playlist whereUpdatedAt($value)
 * @property-read \App\User $author
 * @property integer $fork_parent_id
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Playlist whereForkParentId($value)
 * @property string $slug 
 * @method static \Illuminate\Database\Query\Builder|\App\Playlist whereSlug($value)
 */
class Playlist extends Model implements SluggableInterface {

    use SluggableTrait;

	protected $table = 'playlists';

    protected $sluggable = [];

    public static function findBySlugOrFail($slug)
    {
        if (!is_null($playlist = static::where('slug', $slug)->first()))
        {
            return $playlist;
        }

        throw new ModelNotFoundException;
    }

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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
