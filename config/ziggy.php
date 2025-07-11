<?php

return [
    'except' => [
        'admin.*',
        'api.*',
        'password.*',
        'verification.*',
        'users.destroy',
        'webhooks.*',
        'telescope.*',
        'horizon.*',
    ]
];
