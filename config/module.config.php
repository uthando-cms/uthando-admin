<?php

return [
    'asset_manager' => [
        'resolver_configs' => [
            'collections' => [
                'js/uthando-admin.js' => [
                    'js/loading-overlay.min.js',
                    'js/jquery.datatable.js',
                    'js/admin.js',
                    'js/jquery.ajaxWidgetPanel.js',
                    'js/bootbox.min.js',
                ],
            ],
            'paths' => [
                'UthandoAdmin' => __DIR__ . '/../public',
            ],
        ],
        'caching' => [
            'default' => [
                'cache'     => 'FilesystemCache',
                'options' => [
                    'dir' => 'data/cache', // path/to/cache
                ],
            ],
        ],
        /*'filters' => [
            'js' => [
                ['filter' => 'Assetic\Filter\JSMinFilter'],
            ],
        ],*/
    ],
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
    'controllers' => [
        'invokables' => [
            'UthandoAdmin\Controller\Index' => 'UthandoAdmin\Controller\IndexController',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'UthandoAdmin\Navigation' => 'UthandoAdmin\Service\AdminNavigationFactory',
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'Phpinfo'              => 'UthandoAdmin\View\Phpinfo',
            'UthandoFormElement'   => 'UthandoAdmin\View\UthandoFormElement',
        ],
    ],
    'view_manager' => [
        'template_map' => include __DIR__  .'/../template_map.php',
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
];