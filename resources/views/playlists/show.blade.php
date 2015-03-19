@extends('app')

@section('content')
<div class="container" data-playlist-id="{{ $playlist->id }}">
    <div class="col-md-6">
        <div class="page-header">
            <h1>
                {{ $playlist->name }}
                <small class="pull-right">
                    @if (Auth::user()->owns($playlist))
                        <button class="btn">
                            <i class="fa fa-pencil"></i>
                        </button>
                    @endif
                </small>
            </h1>
        </div>
        @if (!is_null($playlist->forkParent))
            <p class="text-muted">
                <i class="fa fa-code-fork"></i>
                Fork of <a href="{{ route('playlists.show', [$playlist->forkParent]) }}">{{ $playlist->forkParent->name }}</a> by {{ $playlist->forkParent->user->name }}
            </p>
        @endif
        @if (Auth::check())
            <a href="{{ route('playlists.fork', [$playlist]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Fork this playlist">
                <i class="fa fa-code-fork fa-lg"></i>
                <span class="sr-only">Fork this playlist</span>
            </a>
            @if (Auth::user()->owns($playlist))
                <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#delete">
                    <i class="fa fa-trash"></i>
                </button>
            @endif
            <hr>
        @endif
        <p class="text-muted">
            Created {{ $playlist->created_at->diffForHumans() }} by {{ $playlist->user->name }}
        </p>
        @if ($playlist->updated_at > $playlist->created_at)
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
    <div class="clearfix"></div>
    <hr>
    <div class="list-group"></div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this playlist?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('playlists.destroy', [$playlist]) }}" method="post">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-danger">Yes, delete this playlist</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script src="/js/playlists-show.js"></script>
@stop