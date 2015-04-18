/*
 * General
 */
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$('[data-toggle=slide]').click(function() {
    $($(this).data('target')).slideToggle();
});

/*
 * Playlist show
 */
// Stores the YouTube player object
var player;
// Array of YouTube video IDs
var songs = [];
// Is the song currently playing?
var playing = false;

$(document).ready(function () {

    // Get the YouTube video IDs and add them to the songs array
    $('[data-video-id]').each(function () {
        songs.push($(this).data('video-id'));
    });
});

// When a song title is clicked in the list
$(document).on('click', '[data-video-id]', function (e) {
    e.preventDefault();
    player.loadVideoById($(this).data('video-id'));
});

$('#play').click(togglePlay);
$('#previous').click(previous);
$('#next').click(next);

// Toggle the play/pause state of the song
function togglePlay() {
    if (playing) {
        player.pauseVideo();
    } else {
        player.playVideo();
    }
}

// Play the previous song
function previous() {
    var currentSongIndex = songs.indexOf(player.getVideoData().video_id);

    if (currentSongIndex > 0) {
        player.loadVideoById(songs[currentSongIndex - 1]);
    }
}

// Play the next song
function next() {
    var currentSongIndex = songs.indexOf(player.getVideoData().video_id);

    if (currentSongIndex < songs.length - 1) {
        player.loadVideoById(songs[currentSongIndex + 1]);
    }
}

function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {

        // Responsive iFrame
        height: '100%',
        width: '100%',

        // Load the first song
        videoId: songs[0],
        events: {
            'onStateChange': onPlayerStateChange
        }
    });
}

function onPlayerStateChange(event) {
    switch (event.data) {

        case YT.PlayerState.ENDED:

            // Video has ended, so play next song
            next();
            playing = false;
            break;

        case YT.PlayerState.PLAYING:

            // Video is playing
            playing = true;
            break;

        case YT.PlayerState.PAUSED:

            // Video is paused
            playing = false;
            break;
    }

    // Make all songs inactive, then activate the current video
    $('[data-video-id]').removeClass('active');

    // Check that method exists so when it goes to the next song it does not throw an error
    if (typeof player.getVideoData() !== 'undefined') {
        $('[data-video-id=' + player.getVideoData().video_id + ']').addClass('active');
    }

    // Change play button
    $('#play-icon').attr('class', 'fa fa-' + (playing ? 'pause' : 'play'));
}

/*
 * Genre input
 */
if ($('#input-genre').length) {
    // Load genres
    $.ajax({
        url: '/api/genres',
        success: function (genres) {
            loadGenres(genres);
        }
    });
}

function loadGenres(genres) {

    /*
     * Functions
     */

    // Recursively expand all the node's parents
    var expandParents = function(node) {
        var parent = $tree.treeview('getParent', node);

        if (parent !== $tree) {
            $tree.treeview('expandNode', parent);
            expandParents(parent);
        }
    };

    /*
     * jQuery objects
     */
    var $tree = $('#input-genre');
    var $input = $('#genre');

    /*
     * Bootstrap Treeview
     */
    $tree.treeview({
        data: [genres],

        /*
         * Options
         */
        // Don't expand any genres on load
        levels: 1,
        // Icons
        expandIcon: 'fa fa-plus',
        collapseIcon: 'fa fa-minus',
        nodeIcon: 'fa',
        emptyIcon: 'fa',

        // Set to Lumen's default blue
        selectedBackColor: '#158cba',
        // Search results should not be shown
        highlightSearchResults: false,

        /*
         * Events
         */
        // Set the input value so it is sent on form submit
        onNodeSelected: function (event, node) {
            $input.val(node.text);
        },

        // Preselect the correct genre
        onSearchComplete: function (event, results) {
            if (!$.isEmptyObject(results)) {
                var node = results[0];

                $tree.treeview('selectNode', node.nodeId);
                expandParents(node);
            }
        }
    });

    // Preselect the correct genre
    if ($input.val() !== '') {
        $tree.treeview('search', [$input.val(), {
            ignoreCase: true,
            exactMatch: true
        }]);
    }

}
