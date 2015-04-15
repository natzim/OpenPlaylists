$tree = $('#input-genre');
$input = $('#genre');

$tree.treeview({
    data: [
        {
            text: 'Electronic',
            nodes: [
                {
                    text: 'Electro',
                    nodes: [
                        {
                            text: 'Electro rock'
                        }
                    ]
                }
            ]
        },
        {
            text: 'Rock',
            nodes: [
                {
                    text: 'Punk rock'
                }
            ]
        }
    ],
    levels: 1,
    highlightSearchResults: false,
    onNodeSelected: function(event, node) {
        $input.val(node.text);
    },
    onSearchComplete: function(event, results) {
        if (!$.isEmptyObject(results)) {
            var node = results[0];

            $tree.treeview('selectNode', node.nodeId);
            expandParents(node);
        }
    }
});

if ($input.val() !== '') {
    $tree.treeview('search', [$input.val(), {
        ignoreCase: true,
        exactMatch: true
    }]);
}

function expandParents(node) {
    var parent = $tree.treeview('getParent', node);

    if (parent !== $tree) {
        $tree.treeview('expandNode', parent);
        expandParents(parent);
    }
}
