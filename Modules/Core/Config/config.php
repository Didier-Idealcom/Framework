<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Module Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your module.
    |
    */

    'name' => 'Core',

    /*
    |--------------------------------------------------------------------------
    | Backend prefix
    |--------------------------------------------------------------------------
    |
    | This value is the prefix of the backend area.
    |
    */

    'prefix-backend' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | API prefix
    |--------------------------------------------------------------------------
    |
    | This value is the prefix of the API area.
    |
    */

    'prefix-api' => 'api',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | You can customise the Middleware that should be loaded.
    |
    */

    'middleware' => [
       'backend' => [
            'web',
            'theme:metronic'
       ],
       'frontend' => [
            'web'
       ],
       'api' => [
            'api'
       ],
    ],

];
