<?php

return [
    'category'=> [
        'create'=> [
            'success' => 'Category has been added successfully!',
            'error' => 'Create category failed!',
        ],
        'delete'=> [
            'success' => 'Category has been deleted successfully!',
            'error' => 'Delete category failed!',
        ],
        'update'=> [
            'success' => 'Category has been updated successfully!',
            'error' => 'Update category failed!',
        ],
    ],

    'product'=> [
        'create'=> [
            'success' => 'Product has been added successfully!',
            'error' => 'Create product failed!',
        ],
        'delete'=> [
            'success' => 'Product has been deleted successfully!',
            'error' => 'Delete product failed!',
        ],
        'update'=> [
            'success' => 'Product has been updated successfully!',
            'error' => 'Update product failed!',
        ],
    ],

    'cart'=> [
        'update'=> [
            'success' => 'Product has been updated successfully!',
            'error' => 'Update product failed!',
        ],
    ],

    'password'=> [
        'update'=> [
            'success' => 'password has been updated successfully!',
            'error' => [
                'not_match' => 'The password doesn`t match',
                'incorrect' => 'Password is not correct',
            ],
        ],
    ],
];
