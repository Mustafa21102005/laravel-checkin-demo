<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Time-To-Live
    |--------------------------------------------------------------------------
    |
    | How long a generated token is valid for, in seconds, if no explicit
    | expiry is passed to Checkin::generate(). Default: 10 minutes.
    |
    */
    'default_ttl' => (int) env('CHECKIN_DEFAULT_TTL', 600),

    /*
    |--------------------------------------------------------------------------
    | Single Use
    |--------------------------------------------------------------------------
    |
    | If true, a token can only ever be redeemed once. If false, it can be
    | redeemed repeatedly until it expires (e.g. a reusable gym-door pass).
    |
    */
    'single_use' => (bool) env('CHECKIN_SINGLE_USE', true),

    /*
    |--------------------------------------------------------------------------
    | Token Length
    |--------------------------------------------------------------------------
    |
    | Number of random bytes used to generate the raw token before hashing.
    | 32 bytes = 256 bits of entropy, plenty for this use case.
    |
    */
    'token_bytes' => 32,

    /*
    |--------------------------------------------------------------------------
    | Table Name
    |--------------------------------------------------------------------------
    */
    'table' => 'checkin_tokens',
];
