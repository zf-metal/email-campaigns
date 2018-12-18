<?php
/**
 * Created by IntelliJ IDEA.
 * User: afurgeri
 * Date: 17/12/2018
 * Time: 23:08
 */

namespace ZfMetal\EmailCampaigns\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;
use ZfMetal\EmailCampaigns\Service\CampaignService;

class ConsoleCampaignController extends AbstractActionController
{
    /**
     * @var CampaignService
     */
    private $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    /**
     * @return CampaignService
     */
    public function getCampaignService()
    {
        return $this->campaignService;
    }

    public function activeNewCampaignsAction()
    {
        $campaigns = $this->getCampaignService()->activateCampaigns(10);
        return count($campaigns) . ' campaigns activated';
    }

    public function processActivateCampaignsAction()
    {
        $campaigns = $this->getCampaignService()->processCampaigns(10);
        return count($campaigns) . ' campaigns processed';
    }
}