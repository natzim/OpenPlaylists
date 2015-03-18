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
                $('#embed').attr('src', songs[0].url);
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