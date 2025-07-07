<?php

return [
    'default' => env('HASH_DRIVER', 'argon2id'),

    'connections' => [
        'bcrypt' => [
            'driver' => 'bcrypt',
            'rounds' => 10,
        ],

        'argon' => [
            'driver' => 'argon2i',
            'memory' => 1024,
            'time' => 2,
            'threads' => 2,
        ],

        'argon2id' => [
            'driver' => 'argon2id',
            'memory' => 1024,
            'time' => 2,
            'threads' => 2,
        ],
    ],
];
