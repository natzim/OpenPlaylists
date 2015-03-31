<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;

/**
 * App\User
 *
 * @property integer                                                       $id
 * @property string                                                        $name
 * @property string                                                        $email
 * @property string                                                        $password
 * @property string                                                        $remember_token
 * @property \Carbon\Carbon                                                $created_at
 * @property \Carbon\Carbon                                                $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Playlist[] $playlists
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'users';

    protected $hidden = ['password', 'remember_token'];

    protected $fillable = ['name', 'email', 'password'];

    public function owns($resource)
    {
        return $resource->user_id === Auth::id();
    }

    public function playlists()
    {
        return $this->hasMany('App\Playlist');
    }

}
