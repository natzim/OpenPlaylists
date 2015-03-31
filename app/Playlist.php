<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Playlist whereDeletedAt($value)
 */
class Playlist extends Model implements SluggableInterface {

    use SluggableTrait;
    use SoftDeletes;

	protected $table = 'playlists';

    protected $sluggable = [];

    /**
     * Get a playlist from slug
     *
     * @param $slug
     *
     * @return \App\Playlist
     */
    public static function findBySlugOrFail($slug)
    {
        return static::where('slug', $slug)->firstOrFail();
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
