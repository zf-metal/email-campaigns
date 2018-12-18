<?php
/**
 * Created by IntelliJ IDEA.
 * User: afurgeri
 * Date: 15/12/2018
 * Time: 12:09
 */

namespace Test\Service;


use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;
use ZfMetal\EmailCampaigns\Entity\DistributionRecord;
use ZfMetal\EmailCampaigns\Entity\Template;
use ZfMetal\EmailCampaigns\Service\CampaignMailService;
use ZfMetal\EmailCampaigns\Service\Model\CampaignObjects;
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

    private function getModuleOptions()
    {
        return $this->getApplicationServiceLocator()->get('ZfMetal\EmailCampaigns.options');
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

    /**
     * @depends testCreateInstanceOfService
     * @param $campaignService CampaignMailService
     * @return bool|string
     * @throws \Exception
     */
    public function testCreateHtmlTemplate($campaignService)
    {
        $template = $this->getTemplate();
        $htmlTemplate = $campaignService->getHtmlTemplateFromFile($template);

        $this->assertContains("<h1>Title</h1>", $htmlTemplate);

        return $htmlTemplate;
    }

    /**
     * @depends testCreateInstanceOfService
     * @depends testCreateHtmlTemplate
     * @param $campaignService CampaignMailService
     * @param $htmlTemplate
     */
    public function testReplaceTagsByDistributionRecordFields($campaignService, $htmlTemplate)
    {
        $distributionRecord = $this->getDistributionRecord();
        $htmlTemplate = $campaignService->replaceTagsByDistributionRecordFields($distributionRecord, $htmlTemplate);
        $this->assertContains("<li>FirstName</li>", $htmlTemplate);
        $this->assertContains("<li>LastName</li>", $htmlTemplate);
    }

    /**
     * @return Template
     */
    private function getTemplate()
    {
        $template = new Template();
        $template->setName("template.html");
        $template->setFile(__DIR__ . '/../data/tempate.html');
        return $template;
    }

    private function getDistributionRecord()
    {
        $distributionRecord = new DistributionRecord();
        $distributionRecord->setFirstName('FirstName');
        $distributionRecord->setLastName('LastName');
        return $distributionRecord;
    }


}