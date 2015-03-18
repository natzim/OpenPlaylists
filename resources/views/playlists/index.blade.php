@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Playlists</h1>
        @forelse ($playlists as $playlist)
            <div class="well well-sm">
                <span class="badge">{{ $playlist->songs->count() }}</span>
                <a href="{{ route('playlists.show', [$playlist]) }}">{{ $playlist->name }}</a>
            </div>
        @empty
            <p class="lead">Sorry, we couldn't find any playlists!</p>
        @endforelse
    </div>
</div>
@stop