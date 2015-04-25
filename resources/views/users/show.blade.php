@extends('app')

@section('content')
    <div class="page-header">
        <h1>{{ $user->name }}</h1>
    </div>
    <h2>Playlists by {{ $user->name }}</h2>
    @include('partials.playlistlist', [
        'playlists' => $user->playlists()->simplePaginate(15)
    ])
@stop