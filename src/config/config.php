<?php

$config = [
    'db' => [
        'host' => '',
        'login' => 'admin',
        'password' => 'admin',
        'port' => '3306'
    ],
    'salt' => '',
    'dir' => [
        '../controller',
        '../models'
    ],
    'controllers' => [
        'site' => [
            'template' => 'site', 
            'assets' => [
                'title' => 'PHPengineMVC', 
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
