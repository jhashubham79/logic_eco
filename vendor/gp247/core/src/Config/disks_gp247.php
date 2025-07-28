<?php
return [
    'gp247' => [
        'driver'     => 'local',
        'root' => public_path('puloads'),
        'url'        => '/puloads',
        'visibility' => 'public',
        'throw' => false,
    ],
    'tmp' => [
        'driver'     => 'local',
        'root'       => storage_path('tmp'),
        'url'        => '',
    ],
];
