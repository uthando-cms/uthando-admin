<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoAdmin\View
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoAdmin\View;

use Zend\View\Helper\AbstractHelper;

/**
 * Class PhpInfo
 *
 * @package UthandoAdmin\View
 */
class PhpInfo extends AbstractHelper
{ 
    public function __invoke()
    {
        ob_start();
		phpinfo();
		$phpInfo = ob_get_contents();
		ob_end_clean();

		preg_match_all('#<body[^>]*>(.*)</body>#siU', $phpInfo, $output);
        $output = (count($output[1]) > 0) ? implode('', $output[1]) : '';
		$output = preg_replace('#<table#', '<table class="table table-bordered"', $output);
		$output = preg_replace('#(\w),(\w)#', '\1, \2', $output);
		$output = preg_replace('#border="0" cellpadding="3" width="600"#', '', $output);
		$output = preg_replace('#<hr />#', '', $output);
		$output = str_replace('<div class="center">', '', $output);
		$output = str_replace('</div>', '', $output);

		return $output;
    }
}
