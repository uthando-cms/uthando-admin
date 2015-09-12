<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoAdminTest\View
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoAdminTest\View;

use UthandoAdminTest\Framework\TestCase;

class UthandoFormElementTest extends TestCase
{
    public function testCanGetFromServiceManager()
    {
        $helperManager = $this->getApplicationServiceLocator()
            ->get('ViewHelperManager');
        $uthandoFormElement = $helperManager->get('UthandoFormElement');
        $this->assertInstanceOf('UthandoAdmin\View\UthandoFormElement', $uthandoFormElement);
    }
}