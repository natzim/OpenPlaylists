var songs = [];
var currentSong = 0;
var player;
var playing = false;

function newSong(id, title) {
    songs.push({
        id: id,
        title: title
    });
    $('.list-group').append(
        '<a href="#" class="list-group-item" data-video-id="' + id + '">' + title + '</a>'
    );
}

function loadYouTubeIframeAPI() {
    var tag = document.createElement('script');

    tag.src = 'https://www.youtube.com/iframe_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}

function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        height: '100%',
        width: '100%',
        videoId: songs[0].id,
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
}

function onPlayerReady(event) {

}

function previousSong() {
    if (currentSong > 0) {
        currentSong--;
        player.loadVideoById(songs[currentSong].id);
    }
}

function nextSong() {
    if (currentSong < songs.length - 1) {
        currentSong++;
        player.loadVideoById(songs[currentSong].id);
    }
}

$('#next').click(nextSong);
$('#previous').click(previousSong);
$('#play').click(function() {
    if (playing) {
        player.pauseVideo();
    } else {
        player.playVideo();
    }
});
$(document).on('click', '[data-video-id]', function(e) {
    e.preventDefault();
    player.loadVideoById($(this).data('video-id'));
});

function onPlayerStateChange(event) {
    switch (event.data) {
        case YT.PlayerState.ENDED:
            nextSong();
            playing = false;
            break;
        case YT.PlayerState.PLAYING:
            playing = true;
            break;
        case YT.PlayerState.PAUSED:
            playing = false;
            break;
    }
    $('[data-video-id]').removeClass('active');
    $('[data-video-id=' + player.getVideoData().video_id + ']').addClass('active');
    $('#play > i').attr('class', 'fa fa-' + (playing ? 'pause' : 'play'));

}

$(document).ready(function() {
    $.ajax({
        url: document.location + '/songs', // find a better way of doing this
        success: function(ids) {
            var requests = [];

            for (var i = 0; i < ids.length; i++) {
                var id = ids[i].youtube_id;

                requests.push($.ajax({
                    url: 'http://noembed.com/embed?url=https://www.youtube.com/watch?v=' + id,
                    id: id,
                    dataType: 'json',
                    success: function(thing) {
                        newSong(this.id, thing.title)
                    }
                }));
            }
            $.when.apply(null, requests).done(function() {
                loadYouTubeIframeAPI();
            });
        }
    });
});