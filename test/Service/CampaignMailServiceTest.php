<?php
/**
 * Created by IntelliJ IDEA.
 * User: afurgeri
 * Date: 15/12/2018
 * Time: 12:09
 */

namespace Test\Service;


use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;
use ZfMetal\EmailCampaigns\Service\CampaignMailService;
use ZfMetal\Mail\MailManager;

class CampaignMailServiceTest extends AbstractConsoleControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../config/application.config.php'
        );

        parent::setUp();
    }

    /**
     * @return CampaignMailService
     */
    public function testCreateInstanceOfService()
    {
        $mailManager = $this->createMock(MailManager::class);

        $campaignService = new CampaignMailService($mailManager, $this->getModuleOptions());

        $this->assertInstanceOf(CampaignMailService::class, $campaignService);

        return $campaignService;
    }

    private function getModuleOptions(){
        return $this->getApplicationServiceLocator()->get('ZfMetal\EmailCampaigns.options');
    }
}