<?php
/**
 * Created by IntelliJ IDEA.
 * User: afurgeri
 * Date: 15/12/2018
 * Time: 12:13
 */

namespace ZfMetal\EmailCampaigns\Service;

use ZfMetal\EmailCampaigns\Entity\DistributionRecord;
use ZfMetal\EmailCampaigns\Options\ModuleOptions;
use ZfMetal\EmailCampaigns\Service\Model\CampaignObjects;
use ZfMetal\Mail\MailManager;

class CampaignMailService
{
    /**
     * @var MailManager
     */
    private $mailManager;

    private $moduleOptions;

    /**
     * @var CampaignObjects
     */
    private $campaignObject;

    public function __construct(MailManager $mailManager, ModuleOptions $moduleOptions)
    {
        $this->mailManager = $mailManager;
        $this->moduleOptions = $moduleOptions;
    }

    /**
     * @return ModuleOptions
     */
    private function getModuleOptions()
    {
        return $this->moduleOptions;
    }

    /**
     * @return CampaignObjects
     */
    private function getCampaignObject()
    {
        return $this->campaignObject;
    }

    /**
     * @return MailManager
     */
    private function getMailManager()
    {
        return $this->mailManager;
    }

    public function with(CampaignObjects $campaignObjects){
        $this->campaignObject = $campaignObjects;
        return $this;
    }

    public function sendEmail(DistributionRecord $distributionRecord){
        return true;
    }


}