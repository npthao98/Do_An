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
                var html = createHtml(result, data);

                $('.comment').append(html);
                $('textarea[name="content"]').val('');
            },

            error: function(result) {
                window.location.href = '/login';
            }
        });
    });

    $('body').on('click', '.update-comment', function (e) {
        e.preventDefault();
        var _this = $(this);
        var comment_id = _this.data('comment-id');
        var product_comment_id = _this.data('product-comment-id');
        var url = '/comments/edit/' + comment_id;
        var content = $('.edit-content-' + comment_id).val();

        var data = {
            'product_id': product_comment_id,
            'comment_id': comment_id,
            'content' : content,
        };

        $.ajax({
            url: url,
            type: 'PUT',
            data: data,

            success: function(result) {
                $('.at-reply-' + comment_id).text('');
                $('.at-reply-' + comment_id).html(content);
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: result.icon,
                    title: result.message,
                })
            },
        });
    });
});

function createHtml (result, data) {
    var html =
    `<div class="comment-option">
        <div class="co-item">
            <div class="avatar-pic">
                <img src="${result.image}" alt="">
            </div>
            <div class="dropdown">
                <div class="float-right pointer" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    </svg>
                </div>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalEditComment-${result.comment_id}">${result.edit}</a>
                    <a class="dropdown-item" href="#">${result.delete}</a>
                </div>
            </div>
            <div class="modal fade" id="exampleModalEditComment-${result.comment_id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">${result.edit}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control edit-content-${result.comment_id}" id="exampleFormControlTextarea1" rows="3">${result.content}</textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">${result.close}</button>
                            <button type="button" class="btn btn-primary update-comment" data-dismiss="modal" data-comment-id="${result.comment_id}" data-product-comment-id="${data.product_id}">${result.save_change}</button>
                        </div>
                    </div>
                </div>
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
                <div class="at-reply-${result.comment_id}">${data.content}</div>
            </div>
        </div>
    </div><br>`;

    return html;
}
