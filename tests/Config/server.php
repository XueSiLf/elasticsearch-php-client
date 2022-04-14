<?php
return [
    'http' => [
        'x-pack' => [
            'hosts' => ['http://localhost:9200'],
            'username' => '',
            'password' => '',
        ],
        'not-x-pack' => [
            'hosts' => ['http://localhost:9200'],
        ]
    ],
    'https' => [
        'x-pack' => [
            'hosts' => ['https://localhost:9200'],
            'username' => '',
            'password' => '',
        ],
        'not-x-pack' => [
            'hosts' => ['https://localhost:9200'],
        ]
    ]
];