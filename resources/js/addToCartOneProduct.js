$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.pd-cart').click(function(e) {
        e.preventDefault();
        var product_id = $(this).data('product-id');
        var url = '/carts/' + $(this).data('product-id');
        var data = {
            'product_id': product_id,
            'quantity' : $('input[name="quantity"]').val(),
            'color' : $(this).parent().parent().find('select').val(),
            'size' : $(this).parent().parent().find('label.active input').val(),
        };

        $.ajax({
            url: url,
            type: 'POST',
            data: data,

            success: function(result) {
                $('.cart_num').text(result.quantity);
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
