<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Hashids Salt
    |--------------------------------------------------------------------------
    |
    | A salt value for your Hashids. You may use your application key by default.
    |
    */
    'salt' => env('HASHIDS_SALT', env('APP_KEY')),

    /*
    |--------------------------------------------------------------------------
    | Minimum Length
    |--------------------------------------------------------------------------
    |
    | Minimum length for the generated Hashid.
    |
    */
    'min_length' => 8,

    /*
    |--------------------------------------------------------------------------
    | Alphabet
    |--------------------------------------------------------------------------
    |
    | The alphabet used for generating Hashids.
    |
    */
    'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
];
