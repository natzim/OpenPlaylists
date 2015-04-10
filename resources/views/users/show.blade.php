@extends('app')

@section('content')
    <div class="page-header">
        <h1>{{ $user->name }}</h1>
    </div>
    @if (empty($user->playlists))
        <h2>Playlists by {{ $user->name }}</h2>
        @include('partials.playlistlist', [
            'playlists' => $user->playlists()->paginate(15)
        ])
    @endif
@stop