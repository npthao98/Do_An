$(document).ready(function() {
    $(document).on('click', '.pagination a',function(event) {
        event.preventDefault();

        $('li').removeClass('active');
        $(this).parent('li').addClass('active');

        var myurl = $(this).attr('href');
        var page = myurl.split('page=')[1];
        getData(page);
    });
});

function getData(page) {
    $.ajax({
        url: '?page=' + page,
        type: 'GET',
        datatype: 'html',

        success: function(result) {
            $('.tag-container').empty().html(result);
        },
    });
}
