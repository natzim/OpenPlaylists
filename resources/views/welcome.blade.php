@extends('app')

@section('content')
<div class="container">
    <div class="text-center">
        <p class="lead">OpenPlaylists is a simple way of sharing music playlists.</p>
        <a class="btn btn-primary btn-lg" href="{{ route('playlists.index') }}">View playlists</a>
    </div>
</div>
@stop