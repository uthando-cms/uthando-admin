<?php

return [
    'uthando_user' => [
        'acl' => [
            'roles' => [
                'admin' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                'UthandoAdmin\Controller\Index' => ['action' => 'all'],
                            ],
                        ],
                    ],
                ],
            ],
            'resources' => [
                'UthandoAdmin\Controller\Index',
            ],
        ],
	],
	'router' => [
		'routes' => [
			'admin' => [
				'type'          => 'Literal',
				'options'       => [
					'route'    => '/admin',
					'defaults' => [
						'__NAMESPACE__' => 'UthandoAdmin\Controller',
						'controller'    => 'Index',
						'action'        => 'index',
					    'force-ssl'     => 'ssl',
                        'is-admin'      => true,
					],
				],
				'may_terminate' => true,
			],
		],
	],
	'navigation' => [
        'default' => [
            'admin' => [
                'label'     => 'Admin',
                'route'     => 'admin',
                'resource'  => 'menu:admin',
            ],
        ],
		'admin' => [
			'home' => [
				'label'     => 'Home',
				'route'     => 'home',
				'resource'  => 'menu:admin',
			],
			'modules' => [
                'label'     => 'Modules',
                'route'     => 'admin',
                'resource'  => 'menu:admin',
                'pages'     => [],
			],
		],
	],
	'view_manager' => [
	    'template_map' => include __DIR__  .'/../template_map.php',
    ],
];