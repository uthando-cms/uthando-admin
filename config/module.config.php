<?php

return array(
	'admin_options' => array(
		'default_route' => 'admin/application',
	),
	'userAcl' => array(
		'userRoles' => array(
			'guest'	=> array(),
			'registered' => array(),
			'admin' => array(
				'privileges' => array(
					array('controller' => 'Admin\Controller\Admin', 'action' => 'all'),
				),
			),
		),
		'userResources' => array(
			'Admin\Controller\Admin',
		),
	),
	'router' => array(
		'routes' => array(
			'admin' => array(
				'type' => 'Literal',
				'options' => array(
					'route' => '/admin',
					'defaults' => array(
						'__NAMESPACE__' => 'Admin\Controller',
						'controller'    => 'Admin',
						'action'        => 'index',
					    'force-ssl'     => 'ssl'
					),
				),
				'may_terminate' => true,
			),
		),
	),
	'navigation' => array(
		'admin' => array(
			'home' => array(
				'label' => 'Home',
				'route' => 'home',
				'resource' => 'menu:admin',
			),
		),
	),
	'view_manager' => array(
	    'template_map' => include __DIR__  .'/../template_map.php',
    ),
);