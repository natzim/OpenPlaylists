/*
  ######   ######## ##    ## ######## ########     ###    ##
 ##    ##  ##       ###   ## ##       ##     ##   ## ##   ##
 ##        ##       ####  ## ##       ##     ##  ##   ##  ##
 ##   #### ######   ## ## ## ######   ########  ##     ## ##
 ##    ##  ##       ##  #### ##       ##   ##   ######### ##
 ##    ##  ##       ##   ### ##       ##    ##  ##     ## ##
  ######   ######## ##    ## ######## ##     ## ##     ## ########
 */

$(document).ready(function () {

    /**
     * Add song YouTube IDs to the songs array
     */
    $('[data-video-id]').each(function () {
        playlist.songs.push($(this).data('video-id'));
    });

});

/*
 ########  ##          ###    ##    ## ##       ####  ######  ########
 ##     ## ##         ## ##    ##  ##  ##        ##  ##    ##    ##
 ##     ## ##        ##   ##    ####   ##        ##  ##          ##
 ########  ##       ##     ##    ##    ##        ##   ######     ##
 ##        ##       #########    ##    ##        ##        ##    ##
 ##        ##       ##     ##    ##    ##        ##  ##    ##    ##
 ##        ######## ##     ##    ##    ######## ####  ######     ##
 */
var playlist = {

    /*
     * Properties
     */
    songs: [],
    playing: false,

    /*
     * Methods
     */
    /**
     * Get the index in the playlist.songs array that corresponds to the song that is currently playing
     *
     * @return {Number}
     */
    getCurrentSongIndex: function() {
        return playlist.songs.indexOf(playlist.player.getVideoData().video_id);
    },

    /**
     * Called whenever the player changes state
     *
     * @param {Object} event
     */
    stateChange: function(event) {
        switch (event.data) {

            case YT.PlayerState.ENDED:
                playlist.nextSong();
                playlist.playing = false;
                break;

            case YT.PlayerState.PLAYING:
                playlist.playing = true;
                break;

            case YT.PlayerState.PAUSED:
                playlist.playing = false;
                break;
        }

        // Make all songs inactive, then activate the current video
        $('[data-video-id]').removeClass('active');

        // Check that method exists so when it goes to the next song it does not throw an error
        if (typeof playlist.player.getVideoData() !== 'undefined') {
            $('[data-video-id=' + playlist.player.getVideoData().video_id + ']').addClass('active');
        }

        // Change play button
        $('#play-icon').attr('class', 'fa fa-' + (playlist.playing ? 'pause' : 'play'));
    },

    /**
     * Toggle between paused and playing
     */
    togglePlay: function() {
        if (playlist.playing) {
            playlist.player.pauseVideo();
        } else {
            playlist.player.playVideo();
        }
    },

    /**
     * Load the previous song
     */
    previousSong: function() {
        var currentSongIndex = playlist.getCurrentSongIndex();

        if (currentSongIndex > 0) {
            playlist.player.loadVideoById(playlist.songs[currentSongIndex - 1]);
        }
    },

    /**
     * Load the next song
     */
    nextSong: function() {
        var currentSongIndex = playlist.getCurrentSongIndex();

        if (currentSongIndex < playlist.songs.length - 1) {
            playlist.player.loadVideoById(playlist.songs[currentSongIndex + 1]);
        }
    },

    /**
     * Load a specific song by YouTube video ID
     *
     * @param {String} id
     */
    loadSong: function(id) {
        playlist.player.loadVideoById(id);
    }
};

/*
 * Events
 */
/**
 * Load a specific song when a song title is clicked
 */
$(document).on('click', '[data-video-id]', function (e) {
    e.preventDefault();
    playlist.loadSong($(this).data('video-id'));
});

$('#play').click(playlist.togglePlay);
$('#previous').click(playlist.previousSong);
$('#next').click(playlist.nextSong);

/**
 * This function is called by the YouTube iFrame API when it loads
 */
function onYouTubeIframeAPIReady() {
    playlist.player = new YT.Player('player', {

        // Responsive iFrame
        height: '100%',
        width: '100%',

        // Load the first song
        videoId: playlist.songs[0],
        events: {
            'onStateChange': playlist.stateChange
        }
    });
}

/*
  ######   ######## ##    ## ########  ########    #### ##    ## ########  ##     ## ########
 ##    ##  ##       ###   ## ##     ## ##           ##  ###   ## ##     ## ##     ##    ##
 ##        ##       ####  ## ##     ## ##           ##  ####  ## ##     ## ##     ##    ##
 ##   #### ######   ## ## ## ########  ######       ##  ## ## ## ########  ##     ##    ##
 ##    ##  ##       ##  #### ##   ##   ##           ##  ##  #### ##        ##     ##    ##
 ##    ##  ##       ##   ### ##    ##  ##           ##  ##   ### ##        ##     ##    ##
  ######   ######## ##    ## ##     ## ########    #### ##    ## ##         #######     ##
 */
// Only load if required
if ($('#input-genre').length) {
    $.ajax({
        url: '/api/genres',
        success: function (genres) {
            loadGenres(genres);
        }
    });
}

/**
 * Load genres and display them in the input
 *
 * @param {Array} genres
 */
function loadGenres(genres) {

    /*
     * Functions
     */
    /**
     * Recursively expand a parents nodes
     *
     * @param {Object} node
     */
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
        /**
         * Set the input value so it is submitted with the form
         *
         * @param {Object} event
         * @param {Object} node
         */
        onNodeSelected: function (event, node) {
            $input.val(node.text);
        },

        /**
         * Removes the input value if the node is deselected
         */
        onNodeUnselected: function () {
            $input.val('');
        },

        /**
         * Preselect the correct genre
         *
         * @param {Object} event
         * @param {Object} results
         */
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
