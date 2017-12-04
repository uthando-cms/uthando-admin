<?php

use UthandoAdmin\Controller\IndexController;

return [
    'uthando_user' => [
        'acl' => [
            'roles' => [
                'guest' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                IndexController::class => ['action' => [
                                    'login',  'forgot-password',
                                ]],
                            ],
                        ],
                    ],
                ],
                'admin' => [
                    'privileges' => [
                        'deny' => [
                            'controllers' => [
                                IndexController::class => ['action' => [
                                    'login', 'forgot-password'
                                ]],
                            ],
                        ],
                        'allow' => [
                            'controllers' => [
                                IndexController::class => ['action' => ['index', 'logout']],
                            ],
                        ],
                    ],
                ],
            ],
            'resources' => [
                IndexController::class,
            ],
        ],
    ],
];
