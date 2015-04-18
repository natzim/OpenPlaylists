// Load genres
$.ajax({
    url: '/api/genres',
    success: function (genres) {
        loadGenres(genres);
    }
});

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
