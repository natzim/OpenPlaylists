@extends('app')

@section('content')
<div class="container">
    <div class="row" data-playlist-id="{{ $playlist->id }}">
        <div class="row">
            <div class="col-md-6">
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
<script>
    var songs = [];
    var currentSong = null;

    function extractEmbeddableUrlFromHtml(html, site) {
        var segments = html.split(' ');
        var url = '';
        for (var j = 0; j < segments.length; j++) {
            var segment = segments[j];
            if (segment.substring(0, 5) === 'src="') {
                url = segment.substring(5, segment.indexOf('"', 5));
                break;
            }
        }

        switch(site) {
            case 'YouTube':
                url += '&autoplay=1';
                break;
            case 'SoundCloud':
                url += '&auto_play=true';
                break;
        }

        return url;
    }

    $(document).ready(function() {
        var playlistId = $('[data-playlist-id]').data('playlist-id');

        $.ajax({
            url: playlistId + '/songs',
            success: function(urls) {
                var requests = [];

                for (var i = 0; i < urls.length; i++) {
                    var url = urls[i].url;

                    requests.push($.ajax({
                        url: 'http://noembed.com/embed?url=' + url,
                        dataType: 'json',
                        success: function(thing) {
                            songs.push({
                                url: extractEmbeddableUrlFromHtml(thing.html, thing.provider_name),
                                title: thing.title,
                                site: thing.provider_name
                            });
                        }
                    }));
                }
                $.when.apply(null, requests).done(function() {
                    for (var i = 0; i < songs.length; i++) {
                        var song = songs[i];

                        $('.list-container').append(
                            '<div class="well well-sm">' +
                                '<div class="row">' +
                                    '<div class="col-xs-1">' +
                                        '<button type="button" class="btn btn-block btn-default" data-song-index="' + i + '">' +
                                            '<i class="fa fa-play"></i>' +
                                        '</button>' +
                                    '</div>' +
                                    '<div class="col-xs-11">' +
                                        '<p>' + song.title + '</p>' +
                                    '</div>' +
                                '</div>' +
                            '</div>'
                        );
                    }
                });
            }
        });
    });

    $(document).on('click', '[data-song-index]', function() {
        var songIndex = $(this).data('song-index');

        if (songIndex !== currentSong) {
            $('#embed').attr('src', songs[songIndex].url);
            currentSong = songIndex;
            $(this).html('<i class="fa fa-pause"></i>');
        } else {
            // TODO: Pause music
            $(this).html('<i class="fa fa-play"></i>');
        }
    });
</script>
@stop