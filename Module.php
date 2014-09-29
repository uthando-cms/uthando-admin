<?php

namespace UthandoAdmin;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/config.php';
    }
    
    public function getServiceConfig()
    {
    	return [
        	'factories' => [
        		'UthandoAdmin\Navigation' => 'UthandoAdmin\Service\AdminNavigationFactory',
        	],
        ];
    }
    
    public function getControllerConfig()
    {
        return [
        	'invokables' => [
        		'UthandoAdmin\Controller\Index' => 'UthandoAdmin\Controller\IndexController',
        	],
        ];
    }
    
    public function getViewHelperConfig()
    {
        return [
            'invokables' => [
        	    'Phpinfo'              => 'UthandoAdmin\View\Phpinfo',
        	    'UthandoFormElement'   => 'UthandoAdmin\View\UthandoFormElement',
            ],
        ];
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/autoload_classmap.php'
            ],
        ];
    }
}

