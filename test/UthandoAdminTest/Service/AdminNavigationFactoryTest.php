<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoAdmin\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoAdminTest\Service;

use UthandoAdmin\Service\AdminNavigationFactory;
use UthandoAdminTest\Framework\TestCase;

class AdminNavigationFactoryTest extends TestCase
{
    protected static function callMethod($obj, $name, array $args = [])
    {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $args);
    }

    public function testCanGetServiceFromServiceManager()
    {
        $nav = $this->getApplicationServiceLocator()->get('UthandoAdmin\Navigation');
        $adminPage = $nav->findOneBy('label', 'Admin');
        $this->assertSame('Admin', $adminPage->getLabel());
    }

    public function testGetName()
    {
        $class = new AdminNavigationFactory();
        $name = self::callMethod($class, 'getName');
        $this->assertSame('admin', $name);
    }
}
