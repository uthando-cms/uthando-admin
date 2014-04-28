<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AdminController extends AbstractActionController
{
	public function indexAction()
	{	
		$sm = $this->getServiceLocator();
		$config = $sm->get('config');
		
		return $this->redirect()->toRoute($config['admin_options']['default_route']);
	}
}