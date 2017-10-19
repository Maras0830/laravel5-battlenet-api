<?php

return [
    'region' => env('Battle_net_region', 'sea'),
    'api_url' => "https://". env('Battle_net_region', 'sea') .".api.battle.net",
    'api_url_cn' => "https://api.battle.com.cn/",
    'client_id' => env('Battle_net_client_id', ''),
    'client_secret' => env('Battle_net_client_secret', ''),
    'redirect_url' => env('APP_URL'). '/' .env('Battle_net_redirect_url', '') . '/battleNet/callback',
    'scopes' => [
        'wow.profile',
        'sc2.profile'
    ]
];