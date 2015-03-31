@extends('app')

@section('content')
    <div class="page-header">
        <h1>Playlists</h1>
    </div>
    <form>
        <div class="form-group">
            <label for="search">Search</label>
            <input class="form-control" type="text" name="search" id="search" value="{{ old('search') }}">
        </div>
        <button class="btn btn-primary">
            <i class="fa fa-search"></i>
            Search
        </button>
    </form>
    <hr>
    <div class="list-group">
        @forelse ($playlists as $playlist)
            <div class="list-group-item">
                <a href="{{ route('playlists.show', $playlist->slug) }}">{{ $playlist->name }}</a>
                <span class="badge">{{ $playlist->songs->count() }}</span>
            </div>
        @empty
            <p class="lead">Sorry, we couldn't find any playlists!</p>
        @endforelse
    </div>
    {!! $playlists->render() !!}
@stop