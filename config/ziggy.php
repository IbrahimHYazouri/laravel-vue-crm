<?php

return [
    'except' => [
        'admin.*',
        'api.*',
        'verification.*',
        'users.destroy',
        'webhooks.*',
        'telescope.*',
        'horizon.*',
    ]
];
