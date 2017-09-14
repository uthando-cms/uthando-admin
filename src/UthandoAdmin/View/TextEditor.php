<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 14/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoAdmin\View;

use UthandoCommon\View\AbstractViewHelper;

class TextEditor extends AbstractViewHelper
{
    public function summernote()
    {
        return $this->getView()->partial(
            'uthando-admin/partial/summernote'
        );
    }
}
