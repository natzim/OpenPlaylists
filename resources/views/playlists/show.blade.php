@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <h1>{{ $playlist->name }}</h1>
        @if(!empty($playlist->forkParent))
            <p class="text-muted">
                <i class="fa fa-code-fork"></i>
                Fork of <a href="{{ route('playlists.show', [$playlist]) }}">
                    {{ $playlist->forkParent->name }}
                </a>
            </p>
        @endif
        <p>
            <i class="fa fa-user"></i>
            Author: {{ $playlist->user->name }}
        </p>
        <a href="" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Fork this playlist">
            <i class="fa fa-code-fork"></i>
            <span class="sr-only">Fork this playlist</span>
        </a>
        @forelse($playlist->songs as $song)

        @empty
            <p class="lead">Sorry, we couldn't find any songs!</p>
        @endforelse
    </div>
</div>
@stop