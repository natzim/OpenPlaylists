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
 * @property string $youtube_id
 * @method static \Illuminate\Database\Query\Builder|\App\Song whereYoutubeId($value)
 */
class Song extends Model {

	protected $table = 'songs';

    public $timestamps = false;

    protected $visible = ['youtube_id'];

    public function playlist()
    {
        return $this->belongsTo('App\Playlist');
    }

}
