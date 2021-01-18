<?php

return [
    'shipment' => [
        'type_shipment' => 'Type shipment',
        'type' => [
            'fast' => 'Fast Delivery',
            'normal' => 'Normal Delivery',
        ],
        'fee' => 'Fee Shipment',
    ],
    'payment' => [
        'type_payment' => 'Type payment',
        'type' => [
            'cod' => 'Cod',
            'atm' => 'Atm',
            'vnpay' => 'Vnpay',
        ],
    ],
    'vnpay' => [
        'notify' => 'Please do not turn off your browser until when receiving transaction results on the website. Thank you!',
        'application' => 'Mobile application',
        'scan' => 'code scan',
        'payment_online' => 'Online payment',
        'confirm' => 'Confirm',
        'or' => 'Or',
        'cancel' => 'Cancel',
    ],
    'atm' => [
        'list_bank' => 'List of transaction banks',
        'account_number' => 'Account number',
        'account_holder_name' => 'Account holder name (unsigned)',
    ],
];
