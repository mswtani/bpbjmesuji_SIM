<?php

return [

    /*
    |--------------------------------------------------------------------------
    | SIM BPBJ Mesuji
    |--------------------------------------------------------------------------
    */

    'application' => [

        'name' => env('BPBJ_APP_NAME', 'SIM BPBJ Mesuji'),

        'institution' => env('BPBJ_INSTITUTION', 'Bagian Pengadaan Barang dan Jasa Kabupaten Mesuji'),

    ],

    /*
    |--------------------------------------------------------------------------
    | Default Administrator
    |--------------------------------------------------------------------------
    */

    'default_admin' => [

        'nip' => env('BPBJ_ADMIN_NIP', '198905152015031001'),

        'name' => env('BPBJ_ADMIN_NAME', 'Super Administrator'),

        'email' => env('BPBJ_ADMIN_EMAIL', 'admin@localhost'),

        'phone' => env('BPBJ_ADMIN_PHONE', '081373981510'),

        'password' => env('BPBJ_ADMIN_PASSWORD', 'admin12345'),

    ],

];