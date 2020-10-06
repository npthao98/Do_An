$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.site-btn').click(function(e) {
        e.preventDefault();
        var _this = $(this);
        var product_id = $(this).data('product-id');
        var url = '/comments/' + product_id;

        var data = {
            'product_id': product_id,
            'content' : $('textarea[name="content"]').val(),
        };

        $.ajax({
            url: url,
            type: 'POST',
            data: data,

            success: function(result) {
                var html =
                `<div class="comment-option">
                    <div class="co-item">
                        <div class="avatar-pic">
                            <img src="${result.image}" alt="">
                        </div>
                        <div class="avatar-text">
                            <div class="at-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>${result.user}<span>27 Aug 2019</span></h5>
                            <div class="at-reply">${data.content}</div>
                        </div>
                    </div>
                </div><br>`;

                $('.comment').append(html);
                $('textarea[name="content"]').val('');
            },

            error: function(result) {
                window.location.href = '/login';
            }
        });
    });
});
