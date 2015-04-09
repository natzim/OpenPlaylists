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

    /**
     * Find a user by name
     *
     * @param User $query
     * @param string $name
     *
     * @return $this
     */
    public function scopeFindByNameOrFail($query, $name)
    {
        return $query->where('name', $name)
            ->firstOrFail();
    }

    /**
     * Does the current user own the given resource?
     *
     * @param Model $resource
     *
     * @return bool
     */
    public function owns($resource)
    {
        return $resource->user_id === Auth::id();
    }

    /**
     * Find playlists that the user has created
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function playlists()
    {
        return $this->hasMany('App\Playlist');
    }

}
