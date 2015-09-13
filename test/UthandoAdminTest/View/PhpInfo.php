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

class PhpInfoTest extends TestCase
{
    public function testCanGetPhpInfoHelperFromServiceLocator()
    {
        $helperManager = $this->getApplicationServiceLocator()
            ->get('ViewHelperManager');
        $phpInfoHelper = $helperManager->get('PhpInfo');
        $this->assertInstanceOf('UthandoAdmin\View\PhpInfo', $phpInfoHelper);
    }

    public function testPhpInfoReturnHtmlStringOfPhpInfo()
    {
        $helperManager = $this->getApplicationServiceLocator()
            ->get('ViewHelperManager');
        $phpInfoHelper = $helperManager->get('PhpInfo');

        $html = $phpInfoHelper();
        $this->assertSame('', $html);

    }
}