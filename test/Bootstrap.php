<?php

namespace UthandoAdminTest;

use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use RuntimeException;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);
define('APPLICATION_PATH', dirname('../../../'));

/**
 * Test bootstrap, for setting up autoloading
 */
class Bootstrap
{
    protected static $serviceManager;

    public static function init()
    {
        // use ModuleManager to load this module and it's dependencies
        $config = include_once './TestConfig.php.dist';
        static::chroot();

        static::initAutoloader();

        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();
        static::$serviceManager = $serviceManager;
    }

    public static function getServiceManager()
    {
        return static::$serviceManager;
    }

    protected static function initAutoloader()
    {
        // Assumes PHP Composer autoloader w/compiled classmaps, etc.
        require_once 'vendor/autoload.php';

        // This namespace is not in classmap.
        AutoloaderFactory::factory(array(
            'Zend\Loader\StandardAutoloader' => array(
                'autoregister_zf' => true,
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/' . __NAMESPACE__,
                ),
            ),
        ));
    }

    protected static function chroot()
    {
        chdir(__DIR__);

        $previousDir = '.';
        while (!file_exists('config/application.config.php')) {
            $dir = dirname(getcwd());
            if ($previousDir === $dir) {
                throw new RuntimeException(
                    'Unable to locate "config/application.config.php": ' .
                    'is UthandoDomPdf in a subdir of your application skeleton?'
                );
            }
            $previousDir = $dir;
            chdir($dir);
            //define('APPLICATION_PATH', dirname($dir));
        }
    }
}

Bootstrap::init();