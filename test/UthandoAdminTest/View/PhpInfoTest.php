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
    protected function getPhpInfoString()
    {
        ob_start();
        phpinfo();
        $phpInfo = ob_get_contents();
        ob_end_clean();

        preg_match_all('#<body[^>]*>(.*)</body>#siU', $phpInfo, $output);

        $output = preg_replace('#<table#', '<table class="table table-bordered"', implode('',$output[1]));
        $output = preg_replace('#(\w),(\w)#', '\1, \2', $output);
        $output = preg_replace('#border="0" cellpadding="3" width="600"#', '', $output);
        $output = preg_replace('#<hr />#', '', $output);
        $output = str_replace('<div class="center">', '', $output);
        $output = str_replace('</div>', '', $output);

        return $output;
    }

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
        $this->assertSame($this->getPhpInfoString(), $html);

    }
}