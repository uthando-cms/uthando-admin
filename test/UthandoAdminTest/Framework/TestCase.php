<?php

namespace UthandoAdminTest\Framework;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class TestCase extends AbstractHttpControllerTestCase
{
    protected function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../../application.config.php'
        );
        parent::setUp();
    }
}