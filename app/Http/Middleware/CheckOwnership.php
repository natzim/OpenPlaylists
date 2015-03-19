<?php namespace App\Http\Middleware;

use App\Playlist;
use Closure;
use Illuminate\Http\Request;

class CheckOwnership {

    public function handle(Request $request, Closure $next)
    {
        // Oh god this is so bad there must be a better way of doing this
        if (Playlist::findBySlug($request->route()->parameters()['playlists'])->user_id !== $request->user()->id)
        {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }

}
