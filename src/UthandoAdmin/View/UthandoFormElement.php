<?php
namespace UthandoAdmin\View;

use Zend\Form\View\Helper\AbstractHelper;

class UthandoFormElement extends AbstractHelper
{
    protected $parial = 'uthando-admin/partial/tb-form-element';
    
    protected $checkboxRadio = '<div class="%s col-md-offset-2"><label>%s %s</label></div><br>';
    
    public function __invoke()
    {
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
            	    $html .= $partialHelper($this->parial, [
                        'element'   => $this->view->form->get($element),
            	    ]);
            }
        }
        
        return $html;
    }
}
