<?php

namespace Test\Route;

use Doctrine\ORM\EntityManager;
use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class ConsoleRouteTest extends AbstractConsoleControllerTestCase
{
    protected $traceError = true;


    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../config/application.config.php'
        );

        parent::setUp();

    }

    public function testGenerateStructure()
    {

        $this->dispatch('orm:schema-tool:update --force');
        $this->assertResponseStatusCode(0);
        //$this->assertConsoleOutputContains("Updating database schema");
    }

    public function testPopulateInitialData()
    {

        $this->dispatch('initialize_zfec_module');
        $this->assertResponseStatusCode(0);
        //$this->assertConsoleOutputContains("Updating database schema");
    }

}