<?php

return [
    'category' => [
        'create'=> [
            'success' => 'Danh mục được tạo thành công',
            'error' => 'Tạo danh mục thất bại!',
        ],
        'delete'=> [
            'success' => 'Xóa danh mục thành công!',
            'error' => 'Xóa danh mục thất bại!',
        ],
        'update'=> [
            'success' => 'Chỉnh sửa danh mục thành công!',
            'error' => 'Chỉnh sửa danh mục thất bại!',
        ],
    ],

    'product' => [
        'create'=> [
            'success' => 'Sản phẩm được tạo thành công',
            'error' => 'Tạo sản phẩm thất bại!',
        ],
        'delete'=> [
            'success' => 'Xóa sản phẩm thành công!',
            'error' => 'Xóa sản phẩm thất bại!',
        ],
        'update'=> [
            'success' => 'Chỉnh sửa Sản phẩm thành công!',
            'error' => 'Chỉnh sửa sản phẩm thất bại!',
        ],
    ],

    'supplier'=> [
        'create'=> [
            'success' => 'Nhà cung cấp được tạo thành công!',
            'error' => 'Tạo nhà cung cấp thất bại!',
        ],
    ],

    'cart' => [
        'update'=> [
            'success' => 'Chỉnh sửa đơn hàng thành công!',
            'error' => 'Chỉnh sửa đơn hàng thất bại!',
        ],

        'cancel' => [
            'success' => 'Hủy đơn thành công',
            'error' => 'Hủy đơn thất bại',
        ],
    ],

    'password'=> [
        'update'=> [
            'success' => 'Mật khẩu được cập nhập thành công!',
            'error' => [
                'not_match' => 'Mật khẩu không khớp',
                'incorrect' => 'Cập nhập mật khẩu lỗi',
            ],
        ],
    ],

    'comment'=> [
        'update'=> [
            'success' => 'Bình luận được cập nhập thành công',
            'error' => 'Cập nhập bình luận thất bại!',
        ],
    ],

    'user'=> [
        'role'=> [
            'success' => 'Cập nhập thành công!',
            'error' => 'Cập nhập thất bại!',
        ],
        'lock' => [
            'success' => 'Account is locked success',
        ],
        'unlock' => [
            'success' => 'Account is unlocked success',
        ],
        'change_PW' => [
            'success' => 'change password is success',
        ],
    ],

    'notification'=> [
        'delete'=> [
            'success' => 'Thông báo được xóa thành công',
            'error' => 'Xóa thông báo bị lỗi',
        ],
    ],

    'create' => [
        'product' => 'Import must to have product',
    ],

    'import'=> [
        'create'=> [
            'success' => 'Import has been added successfully!',
            'error' => 'Create Import failed!',
        ],
    ],
];
