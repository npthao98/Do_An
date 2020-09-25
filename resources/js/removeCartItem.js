$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.remove-one-item').click(function() {
        var product_detail_id = $(this).data('product-detail-id');
        var url = '/carts/' + product_detail_id;
        var _this = $(this);
        var data = {
            'product_detail_id': product_detail_id,
        };

        $.ajax({
            url: url,
            type: 'DELETE',
            data: data,

            success: function(result) {
                _this.parent().parent().remove();
                sweetDelete(result.icon, result.message);
            },

            error: function(result) {
                sweetDelete(result.icon, result.message);
            }
        });
    });

    $('.remove-all').click(function() {
        var _this = $(this);
        var url = '/carts';

        $.ajax({
            url: url,
            type: 'DELETE',

            success: function(result) {
                $('#cart-body').remove();
                sweetDelete(result.icon, result.message);
            },

            error: function(result) {
                sweetDelete(result.icon, result.message);
            }
        });
    });
});

function sweetDelete(icon, message) {
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
        icon: icon,
        title: message
    })
}
