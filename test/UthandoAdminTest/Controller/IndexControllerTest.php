<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoAdminTest\Controller
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoAdminTest\Controller;

use UthandoAdminTest\Framework\TestCase;
use UthandoUser\Model\User as TestUserModel;

class IndexControllerTest extends TestCase
{
    protected $traceError = true;

    public function testAdminCanAccessIndexAction()
    {
        /* @var $auth \UthandoUser\Service\Authentication */
        $auth = $this->getApplicationServiceLocator()
            ->get('Zend\Authentication\AuthenticationService');
        $user = new TestUserModel();

        $user->setFirstname('Joe')
            ->setLastname('Bloggs')
            ->setEmail('email@example.com')
            ->setRole('admin');
        $auth->getStorage()->write($user);

        $this->dispatch('/admin');
        $this->assertEquals('200', $this->getResponse()->getContent());
        //$this->assertResponseStatusCode(200);

        $this->assertModuleName('UthandoAdmin');
        $this->assertControllerName('UthandoAdmin\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('admin');
    }

    public function testIndexActionRedirectsIfNotAuthenticated()
    {
        $this->dispatch('/admin');
        $this->assertResponseStatusCode(302);

        $this->assertRedirectTo('/user');
    }

    public function testRegisteredUserRedirectsToHome()
    {
        /* @var $auth \UthandoUser\Service\Authentication */
        $auth = $this->getApplicationServiceLocator()
            ->get('Zend\Authentication\AuthenticationService');
        $user = new TestUserModel();

        $user->setFirstname('Joe')
            ->setLastname('Bloggs')
            ->setEmail('email@example.com')
            ->setRole('registered');
        $auth->getStorage()->write($user);

        $this->dispatch('/admin');

        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/');
    }


}