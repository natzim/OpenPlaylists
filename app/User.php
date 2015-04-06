<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'users';

    protected $hidden = ['password', 'remember_token'];

    protected $fillable = ['name', 'email', 'password'];

    public function scopeFindByNameOrFail($query, $name)
    {
        return $query->where('name', $name)
            ->firstOrFail();
    }

    public function owns($resource)
    {
        return $resource->user_id === Auth::id();
    }

    public function playlists()
    {
        return $this->hasMany('App\Playlist');
    }

}
