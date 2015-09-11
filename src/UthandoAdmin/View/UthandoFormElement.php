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

use Zend\Form\View\Helper\AbstractHelper;

/**
 * Class UthandoFormElement
 *
 * @package UthandoAdmin\View
 */
class UthandoFormElement extends AbstractHelper
{
    protected $partial = 'uthando-admin/partial/tb-form-element';
    
    protected $checkboxRadio = '<div class="%s col-md-offset-2"><label>%s %s</label></div><br>';

    protected $options = [
        'labelWidth'    => '2',
        'elementWidth'  => '4',
    ];
    
    public function __invoke($options = [])
    {
        $options = array_merge($this->options, $options);

        $formElementHelper = $this->view->plugin('formElement');
        
        /** @var \Zend\View\Helper\Partial $partialHelper */
        $partialHelper = $this->view->plugin('partial');
        
        $html = '';
        
        foreach ($this->view->formElements as $element) {
            switch ($this->view->form->get($element)->getAttribute('type')) {
            	case 'hidden':
            	    $html .= $formElementHelper($this->view->form->get($element));
            	    break;
            	case 'checkbox':
            	case 'radio':
            	    $html .= sprintf(
            	       $this->checkboxRadio,
            	       $element,
            	       $this->view->form->get($element)->getLabel(),
            	       $formElementHelper($this->view->form->get($element))
                    );
            	    break;
            	default:
            	    $html .= $partialHelper($this->partial, [
                        'element'   => $this->view->form->get($element),
                        'options'   => $options,
            	    ]);
            }
        }
        
        return $html;
    }
}
