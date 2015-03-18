@extends('app')

@section('content')
<div class="container">
    <div class="row">
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
        @forelse ($playlists as $playlist)
            <div class="well well-sm">
                <span class="badge">{{ $playlist->songs->count() }}</span>
                <a href="{{ route('playlists.show', [$playlist]) }}">{{ $playlist->name }}</a>
            </div>
        @empty
            <p class="lead">Sorry, we couldn't find any playlists!</p>
        @endforelse
        {{ $playlists->render() }}
    </div>
</div>
@stop