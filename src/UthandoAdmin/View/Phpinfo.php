<?php
namespace UthandoAdmin\View;

use Zend\View\Helper\AbstractHelper;

class Phpinfo extends AbstractHelper
{ 
    public function __invoke()
    {
        ob_start();
		phpinfo();
		$phpinfo = ob_get_contents();
		ob_end_clean();

		preg_match_all('#<body[^>]*>(.*)</body>#siU', $phpinfo, $output);
		$output = preg_replace('#<table#', '<table class="table table-bordered"', $output[1][0]);
		$output = preg_replace('#(\w),(\w)#', '\1, \2', $output);
		$output = preg_replace('#border="0" cellpadding="3" width="600"#', '', $output);
		$output = preg_replace('#<hr />#', '', $output);
		$output = str_replace('<div class="center">', '', $output);
		$output = str_replace('</div>', '', $output);

		return $output;
    }
}
