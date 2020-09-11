$(document).ready(function(){
    $('.button-logout').click(function() {
        event.preventDefault();
        $('#logout-form').submit();
    });
});
