@extends('app')

@section('content')
<div class="container">
    <div class="row" data-playlist-id="{{ $playlist->id }}">
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
        <hr>
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" id="embed"></iframe>
        </div>
        <hr>
        <div class="list-container"></div>
    </div>
</div>
@stop

@section('scripts')
<script>
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
                var songs = [];
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
                        var faSite = '';

                        switch (song.site) {
                            case 'YouTube':
                                faSite = 'youtube-play';
                                break;
                            case 'SoundCloud':
                                faSite = 'cloud';
                                break;
                        }

                        $('.list-container').append(
                            '<h2><i class="fa fa-' + faSite + '"></i> ' + song.title + '</h2>'
                        );
                    }
                    $('#embed').attr('src', songs[0].url);
                });
            }
        });
    });
</script>
@stop