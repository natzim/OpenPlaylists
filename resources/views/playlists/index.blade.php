@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Playlists</h1>
        @forelse ($playlists as $playlist)
            <p>{{ $playlist->name }}</p>
        @empty
            <p class="lead">Sorry, we couldn't find any playlists!</p>
        @endforelse
    </div>
</div>
@stop