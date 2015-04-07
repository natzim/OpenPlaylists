@extends('app')

<?php
$owns = Auth::check() && Auth::user()->owns($playlist);
?>

@section('content')
    <div class="col-md-6">
        <div class="page-header">
            <h1>
                {{ $playlist->name }}
                <small class="pull-right">
                    @if ($owns)
                        <button class="btn" data-toggle="modal" data-target="#edit">
                            <i class="fa fa-pencil"></i>
                            <span class="sr-only">Edit this playlist</span>
                        </button>
                    @endif
                </small>
            </h1>
        </div>
        @if ($playlist->isFork())
            <p class="text-muted">
                <i class="fa fa-code-fork"></i>
                Fork of <a href="{{ route('playlists.show', $playlist->forkParent->slug) }}">{{ $playlist->forkParent->name }}</a> by
                <a href="{{ route('users.show', $playlist->forkParent->user->name) }}">{{ $playlist->forkParent->user->name }}</a>
            </p>
        @endif
        @if (Auth::check())
            <button class="btn btn-success" data-toggle="modal" data-target="#fork">
                <i class="fa fa-code-fork fa-lg"></i>
                <span class="sr-only">Fork this playlist</span>
            </button>
            @if ($owns)
                <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#delete">
                    <i class="fa fa-trash"></i>
                    <span class="sr-only">Delete this playlist</span>
                </button>
            @endif
            <hr>
        @endif
        @if (!empty($playlist->genre->name))
            <h3>@include('partials.genre', ['genre' => $playlist->genre])</h3>
        @endif
        <p class="text-muted">
            Created {{ $playlist->created_at->diffForHumans() }} by <a href="{{ route('users.show', $playlist->user->name) }}">{{ $playlist->user->name }}</a>
        </p>
        @if ($playlist->hasBeenUpdated())
            <p class="text-muted">
                Updated {{ $playlist->updated_at->diffForHumans() }}
            </p>
        @endif
    </div>
    <div class="col-md-6 well">
        <div class="embed-responsive embed-responsive-16by9">
            <div id="player"></div>
        </div>
        <hr>
        <div class="text-center">
            <div class="btn-group btn-group-lg" role="group" aria-label="Playlist controls">
                <button type="button" class="btn btn-default" id="previous">
                    <i class="fa fa-fast-backward"></i>
                    <span class="sr-only">Previous song</span>
                </button>
                <button type="button" class="btn btn-default" id="play">
                    <i class="fa fa-play" id="play-icon"></i>
                    <span class="sr-only">Play/Pause song</span>
                </button>
                <button type="button" class="btn btn-default" id="next">
                    <i class="fa fa-fast-forward"></i>
                    <span class="sr-only">Next song</span>
                </button>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <hr>
    <div class="list-group">
        @foreach ($playlist->songs as $song)
            <a href="#" class="list-group-item" data-video-id="{{ $song->youtube_id }}">{{ $song->name }}</a>
        @endforeach
    </div>

    @if (Auth::check())
        <div class="modal fade" id="fork" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Fork this playlist?</h4>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('playlists.fork', $playlist->slug) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-success">Fork</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($owns)
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Delete this playlist?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this playlist?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('playlists.destroy', $playlist->slug) }}" method="post">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-danger">Yes, delete this playlist</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('playlists.update', $playlist->slug) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="put">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <button class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop

@section('scripts')
    <script src="/js/playlists-show.js"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
@stop