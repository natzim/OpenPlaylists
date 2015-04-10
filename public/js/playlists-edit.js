$('.list-group').sortable({
    placeholder: '<a href="#" class="list-group-item list-group-item-info">&nbsp;</a>'
});

/*
$('form').submit(function(e) {
    e.preventDefault();

    var formData = $(this).serializeArray();

    $('.list-group > .list-group-item').each(function() {
        formData.push({
            name: 'songs[]',
            value: $(this).data('video-id')
        });
    });

    console.log(formData);

    //$.ajax({
    //    url: 'update',
    //    method: 'put',
    //    data: formData
    //})
});*/
