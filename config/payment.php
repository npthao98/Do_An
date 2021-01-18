<?php

return [
    'shipment' => [
        'type' => [
            'fast' => 'fast',
            'normal' => 'normal',
        ],
        'fee' => [
            'fast' => 30000,
            'normal' => 15000,
        ],
    ],
    'payment' => [
        'type' => [
            'cod' => 'cod',
            'atm' => 'atm',
            'vnpay' => 'vnpay',
        ],
        'status' => [
            'paid' => 1,
            'unpaid' => 0,
        ],
    ],
];
