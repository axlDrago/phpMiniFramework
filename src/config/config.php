<?php

$config = [
    'db' => [
        'host' => 'db',
        'login' => 'admin',
        'password' => 'admin',
        'port' => '3306',
        'dbname' => 'development',
        'charset' => 'utf8'
    ],
    'salt' => 'salt',
    'dir' => [
        '../controller',
        '../models'
    ],
    'controllers' => [
        'site' => [
            'template' => 'site', 
            'assets' => [
                'title' => 'Ezhevika Menu', 
                'css' => [], 
                'js' => []
            ]
        ],
        'auth' => [
            'template' => 'auth',
            'assets' => [
                'title'=>'Авторизация', 
                'css' => [],
                'js' => []
            ]
        ]
    ]
];
