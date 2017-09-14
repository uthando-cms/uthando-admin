<?php

use UthandoAdmin\View\TextEditor;

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
                'js/summernote.js' => [
                    'summernote.js',
                ],
                'css/uthando-admin.css' => [
                    'css/admin.css',
                ],
            ],
            'map' => [
                'summernote.js' => 'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js',
                'css/summernote.css' => 'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css',
                'css/font/summernote.ttf' => 'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/font/summernote.ttf',
                'css/font/summernote.woff' => 'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/font/summernote.woff',
            ],
            'paths' => [
                'UthandoAdmin' => __DIR__ . '/../public',
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
            'PhpInfo' => 'UthandoAdmin\View\PhpInfo',
            'UthandoFormElement' => 'UthandoAdmin\View\UthandoFormElement',
            'TextEditor' => TextEditor::class,
        ],
    ],
    'view_manager' => [
        'template_map' => include __DIR__ . '/../template_map.php',
    ],
    'router' => [
        'routes' => [
            'admin' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/admin',
                    'defaults' => [
                        '__NAMESPACE__' => 'UthandoAdmin\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                        'force-ssl' => 'ssl',
                        'is-admin' => true,
                    ],
                ],
                'may_terminate' => true,
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            'admin' => [
                'label' => 'Admin',
                'route' => 'admin',
                'resource' => 'menu:admin',
            ],
        ],
        'admin' => [
            'home' => [
                'params' => [
                    'icon' => 'fa-home',
                ],
                'label' => 'Home',
                'route' => 'home',
                'resource' => 'menu:admin',
            ],
            'admin' => [
                'label' => 'Admin',
                'params' => [
                    'icon' => 'fa-tachometer',
                ],
                'route' => 'admin',
                'resource' => 'menu:admin',
                'pages' => [
                    'phpinfo' => [
                        'label' => 'PHP Info',
                        'route' => 'admin',
                        'resource' => 'menu:admin'
                    ],
                    'settings' => [
                        'label' => 'Settings',
                        'uri' => '#',
                        'resource' => 'menu:admin',
                    ],
                ],
            ],
        ],
    ],
];