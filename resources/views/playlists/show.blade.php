@extends('app')

@section('content')
<div class="container">
    <div class="row" data-playlist-id="{{ $playlist->id }}">
        <div class="row">
            <div class="col-md-6">
                <h1>{{ $playlist->name }}</h1>
                @if(!is_null($playlist->forkParent))
                    <p class="text-muted">
                        <i class="fa fa-code-fork"></i>
                        Fork of <a href="{{ route('playlists.show', [$playlist->forkParent]) }}">
                            {{ $playlist->forkParent->name }}
                        </a>
                    </p>
                @endif
                <p>
                    <i class="fa fa-user"></i>
                    Author: {{ $playlist->user->name }}
                </p>
                <a href="{{ route('playlists.fork', [$playlist]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Fork this playlist">
                    <i class="fa fa-code-fork fa-lg"></i>
                    <span class="sr-only">Fork this playlist</span>
                </a>
            </div>
            <div class="col-md-6">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" id="embed"></iframe>
                </div>
                <hr>
                <div class="text-center">
                    <div class="btn-group btn-group-lg" role="group" aria-label="Playlist controls">
                        <button type="button" class="btn btn-default" id="previous">
                            <i class="fa fa-fast-backward"></i>
                            <span class="sr-only">Previous song</span>
                        </button>
                        <button type="button" class="btn btn-default" id="play">
                            <i class="fa fa-play"></i>
                            <span class="sr-only">Play/Pause song</span>
                        </button>
                        <button type="button" class="btn btn-default" id="next">
                            <i class="fa fa-fast-forward"></i>
                            <span class="sr-only">Next song</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="list-container"></div>
    </div>
</div>
@stop

@section('scripts')
<script src="/js/playlists-show.js"></script>
@stop