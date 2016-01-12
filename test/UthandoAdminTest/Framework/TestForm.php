<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoAdminTest\Framework
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2016 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoAdminTest\Framework;

use Zend\Form\Form;

class TestForm extends Form
{
    public function __construct($name, array $options = [])
    {
        parent::__construct($name, $options);

        $this->add([
            'name' => 'hidden_element',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'radio_element',
            'type' => 'radio',
        ]);

        $this->add([
            'name' => 'checkbox_element',
            'type' => 'checkbox',
        ]);

        $this->add([
            'name' => 'default_element',
            'type' => 'text',
        ]);
    }
}
