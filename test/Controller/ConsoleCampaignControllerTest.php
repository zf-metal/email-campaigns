<?php
/**
 * Created by IntelliJ IDEA.
 * User: afurgeri
 * Date: 17/12/2018
 * Time: 23:02
 */

namespace Test\Controller;


use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;
use ZfMetal\EmailCampaigns\Service\CampaignService;

class ConsoleCampaignControllerTest extends AbstractConsoleControllerTestCase
{
    protected $traceError = true;

    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../config/application.config.php'
        );

        parent::setUp();
        $this->configureServiceLocator();
    }

    private function configureServiceLocator()
    {
        $this->getApplicationServiceLocator()->setAllowOverride(true);
        $this->getApplicationServiceLocator()->setService(CampaignService::class, $this->getCampaignService());
        $this->getApplicationServiceLocator()->setAllowOverride(false);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function getCampaignService()
    {
        $campaignService = $this->createMock(CampaignService::class);
        $campaignService->method('activateCampaigns')->willReturn([]);
        return $campaignService;
    }

    public function testActiveCampaignFromCommandConsole(){
        $this->dispatch('activeNewCampaigns');
        $this->assertResponseStatusCode(0);
        $this->assertContains("campaigns activated", $this->getResponse()->getContent());
    }

    public function testProcessCampaignFromCommandConsole(){
        $this->dispatch('processActivateCampaigns');
        $this->assertResponseStatusCode(0);
        $this->assertContains("campaigns processed", $this->getResponse()->getContent());
    }
}