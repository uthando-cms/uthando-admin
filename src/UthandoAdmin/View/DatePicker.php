<?php declare(strict_types=1);
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @author      Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link        https://github.com/uthando-cms for the canonical source repository
 * @copyright   Copyright (c) 15/09/17 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license     see LICENSE
 */

namespace UthandoAdmin\View;

use UthandoCommon\View\AbstractViewHelper;

class DatePicker extends AbstractViewHelper
{
    public function __invoke($date)
    {
        $view = $this->getView();

        $view->headLink()->appendStylesheet($view->basePath('css/bootstrap-datetimepicker.css'));
        $view->inlineScript()->appendFile($view->basePath('js/bootstrap-datetimepicker.js'));
        $view->placeholder('js-scripts')->append(
            $view->partial(
                'uthando-admin/partial/date-picker', [
                    'date' => $date,
                ])
        );
    }
}
