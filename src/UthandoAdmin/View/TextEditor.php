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
        $view = $this->getView();

        $view->headLink()->appendStylesheet($view->basePath('css/summernote.css'));
        $view->inlineScript()->appendFile($view->basePath('js/summernote.js'));

        $view->placeholder('js-scripts')->append(
            $view->partial(
                'uthando-admin/partial/summernote'
            )
        );
    }

    public function codeMirror()
    {
        $view = $this->getView();
        $view->headLink()->appendStylesheet($view->basePath('css/codemirror.css'));
        $view->inlineScript()->appendFile($view->basePath('js/codemirror.js'));

        $view->placeholder('js-scripts')->append(
            $view->partial(
                'uthando-admin/partial/code-mirror'
            )
        );
    }
}
