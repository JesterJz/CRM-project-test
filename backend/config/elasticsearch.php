<?php
return [
    'hosts' => [
        [
            'host' => env('ELASTICSEARCH_HOST', 'elasticsearch'),
            'port' => env('ELASTICSEARCH_PORT', 9200),
            'scheme' => env('ELASTICSEARCH_SCHEME', 'http'),
        ],
    ],
];

