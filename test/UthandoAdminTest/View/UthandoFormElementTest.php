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
use UthandoAdminTest\Framework\TestForm;

class UthandoFormElementTest extends TestCase
{
    public function testCanGetFromServiceManager()
    {
        $helperManager = $this->getApplicationServiceLocator()
            ->get('ViewHelperManager');
        $uthandoFormElement = $helperManager->get('UthandoFormElement');
        $this->assertInstanceOf('UthandoAdmin\View\UthandoFormElement', $uthandoFormElement);
    }

    public function testReturnAHtmlString()
    {
        $helperManager = $this->getApplicationServiceLocator()
            ->get('ViewHelperManager');
        /* @var \UthandoAdmin\View\UthandoFormElement $formElementHelper */
        $formElementHelper = $helperManager->get('UthandoFormElement');
        $formElementHelper->getView()->setVars([
            'form' => new TestForm('Test Form'),
            'formElements' => [
                'hidden_element', 'radio_element', 'checkbox_element', 'default_element',
            ],
        ]);

        $html = $formElementHelper();

        $this->assertInternalType('string', $html);
    }
}