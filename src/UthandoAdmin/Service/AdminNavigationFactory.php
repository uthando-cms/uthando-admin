<?php
namespace UthandoAdmin\Service;

use Zend\Navigation\Service\AbstractNavigationFactory;

class AdminNavigationFactory extends AbstractNavigationFactory
{
	protected function getName()
	{
		return 'admin';
	}
}
