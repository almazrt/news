<?php

return [

    'client' => [
        'mock_enable' => (bool)env('HTTP_CLIENT_MOCK_ENABLE', false),
        'log_enable' => (bool)env('HTTP_CLIENT_LOG_ENABLE', true),
    ],

];
