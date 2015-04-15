$('#input-genre').treeview({
    data: [
        {
            text: 'Electronic',
            nodes: [
                {
                    text: 'Electro'
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
    onNodeSelected: function(event, node) {
        $('#genre').val(node.text);
    }
});