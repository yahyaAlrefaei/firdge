<?php

return [

    'boolean' => [
        0 => 'No',
        1 => 'Yes',
    ],

    'role' => [
        1 => 'Admin',
        2 => 'Client',
    ],

    'status' => [
        1 => 'Active',
        0 => 'Inactive',
    ],

    'avatar' => [
        'public' => '/uploads/avatar/',
        'folder' => 'avatar',

        'width'  => 400,
        'height' => 400,
    ],

    'logo' => [
        'public' => '/uploads/logo/',
        'folder' => 'logo',

        'width'  => 250,
        'height' => 250,
    ],
    'background_images' => [
        'public' => '/uploads/background_images/',
        'folder' => 'background_images',

        'width'  => 250,
        'height' => 250,
    ],

    /*
    |------------------------------------------------------------------------------------
    | ENV of APP
    |------------------------------------------------------------------------------------
    */
    'APP_ADMIN' => 'admin',
    'APP_TOKEN' => env('APP_TOKEN', 'admin123456'),
    'WITH_FAKER' => env('WITH_FAKER', false),
];
