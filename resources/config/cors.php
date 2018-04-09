<?php

return [
    'supportsCredentials' => true,
    'allowedOrigins'      => [
        'http://www.kabooodle.ngrok.io',
        'http://api.kabooodle.ngrok.io',
        'http://kabooodle.ngrok.io',

        'http://kabooodle.local',
        'http://www.kabooodle.local',
        'http://app.kabooodle.local',
        'http://api.kabooodle.local',

        'http://kabooodle.net',
        'http://www.kabooodle.net',
        'http://api.kabooodle.net',
        'http://app.kabooodle.net',

        'http://www.kabooodle.com',
        'http://kabooodle.com',
        'http://app.kabooodle.com',
        'http://api.kabooodle.com',
        'https://www.kabooodle.com',
        'https://kabooodle.com',
        'https://app.kabooodle.com',
        'https://api.kabooodle.com',

        'http://d1xa16vtrvw19v.cloudfront.net', // net
        'http://d1o4ibed66ebi1.cloudfront.net', // com
        'https://d1o4ibed66ebi1.cloudfront.net', // com
        'http://d2jx59dcc1ko56.cloudfront.net', // dev
    ],
    'allowedHeaders'      => ['*'],
    'allowedMethods' => ['GET', 'POST', 'PUT',  'DELETE', 'OPTIONS'],
    'exposedHeaders'      => [],
    'maxAge'              => 3600,
    'hosts'               => [],
];

