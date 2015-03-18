<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Song
 *
 * @property-read \App\Playlist $playlist
 * @property integer $id
 * @property integer $playlist_id
 * @property string $url
 * @method static \Illuminate\Database\Query\Builder|\App\Song whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Song wherePlaylistId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Song whereUrl($value)
 */
class Song extends Model {

	protected $table = 'songs';

    public $timestamps = false;

    protected $visible = ['url'];

    public function playlist()
    {
        return $this->belongsTo('App\Playlist');
    }

}
