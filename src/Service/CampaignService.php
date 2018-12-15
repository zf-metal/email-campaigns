<?php

namespace ZfMetal\EmailCampaigns\Service;

use ZfMetal\EmailCampaigns\Constants;
use ZfMetal\EmailCampaigns\Entity\Campaign;
use ZfMetal\EmailCampaigns\Repository\CampaignRepository;

class CampaignService
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var CampaignRecordService
     */
    private $campaignRecordService;

    public function __construct(\Doctrine\ORM\EntityManager $em, CampaignRecordService $campaignRecordService)
    {
        $this->em = $em;
        $this->campaignRecordService = $campaignRecordService;
    }

    public function getEm()
    {
        return $this->em;
    }

    /**
     * @return CampaignRecordService
     */
    public function getCampaignRecordService()
    {
        return $this->campaignRecordService;
    }

    /**
     * @return CampaignRepository
     */
    public function getCampaignRepository()
    {
        return $this->getEm()->getRepository(Constants::ENTITY_CAMPAIGN);
    }

    public function activateCampaigns($limit = 10)
    {
        $campaigns = $this->getCampaignRepository()->getNewCampaigns($limit);

        for ($i = 0; $i < count($campaigns); $i++) {
            $campaign = $campaigns[$i];
            $this->activateCampaign($campaign);
        }

        return $campaigns;
    }

    public function processCampaigns($limit = 10)
    {
        $campaigns = $this->getCampaignRepository()->getActivatedCampaigns($limit);

        for ($i = 0; $i < count($campaigns); $i++) {
            $campaign = $campaigns[$i];
            $this->processCampaign($campaign);
        }

        return $campaigns;
    }

    private function createCampaignRecords($campaign)
    {
        $this->getCampaignRecordService()->createCampaignRecords($campaign);
    }

    /**
     * @param $campaign
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function activateCampaign($campaign)
    {
        $this->createCampaignRecords($campaign);
        $campaign->setState($this->getEm()->getReference(Constants::ENTITY_CAMPAIGN_STATE, Constants::CAMPAIGN_ACTIVATED));
        $this->getEm()->persist($campaign);
        $this->getEm()->flush();
    }

    private function processCampaign($campaign)
    {
        /** @var $campaign Campaign */
        $resutl = $this->processCampaignRecords($campaign);
        $state = $resutl ? Constants::CAMPAIGN_FINISHED : Constants::CAMPAIGN_FAILED;
        $campaign->setState($this->getEm()->getReference(Constants::ENTITY_CAMPAIGN_STATE, $state));
        $campaign->setFinishDate(new \DateTime());
        $this->getEm()->persist($campaign);
        $this->getEm()->flush();
    }

    private function processCampaignRecords($campaign)
    {
        return $this->getCampaignRecordService()->processCampaingRecords($campaign);
    }
}
