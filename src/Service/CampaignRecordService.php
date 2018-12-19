<?php

namespace ZfMetal\EmailCampaigns\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use ZfMetal\EmailCampaigns\Constants;
use ZfMetal\EmailCampaigns\Entity\Campaign;
use ZfMetal\EmailCampaigns\Entity\CampaignRecord;
use ZfMetal\EmailCampaigns\Entity\CampaignRecordState;
use ZfMetal\EmailCampaigns\Entity\DistributionList;
use ZfMetal\EmailCampaigns\Entity\DistributionRecord;
use ZfMetal\EmailCampaigns\Options\ModuleOptions;
use ZfMetal\EmailCampaigns\Service\Model\CampaignObjects;

/**
 * Class CampaignRecordService
 * @package ZfMetal\EmailCampaigns\Service
 */
class CampaignRecordService
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var CampaignMailService
     */
    private $campaignMailService;

    /**
     * @var ModuleOptions
     */
    private $moduleOptions;

    /**
     * CampaignRecordService constructor.
     * @param EntityManager $em
     * @param CampaignMailService $campaignMailService
     */
    public function __construct(EntityManager $em, CampaignMailService $campaignMailService, ModuleOptions $moduleOptions)
    {
        $this->em = $em;
        $this->campaignMailService = $campaignMailService;
        $this->moduleOptions = $moduleOptions;
    }

    /**
     * @return EntityManager
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @return CampaignMailService
     */
    public function getCampaignMailService()
    {
        return $this->campaignMailService;
    }

    /**
     * @return ModuleOptions
     */
    public function getModuleOptions()
    {
        return $this->moduleOptions;
    }

    /**
     * @param $campaign
     * @throws \Doctrine\ORM\ORMException
     * @throws OptimisticLockException
     */
    public function createCampaignRecords($campaign)
    {
        /** @var $campaign Campaign */
        /** @var $distributionList DistributionList */
        $distributionList = $campaign->getDistributionList();
        $distributionRecords = $this->getDistributionRecords($distributionList);

        for ($i = 0; $i < count($distributionRecords); $i++) {
            /** @var $distributionRecord DistributionRecord */
            $distributionRecord = $distributionRecords[$i];
            $cr = $this->createCampaignRecord($campaign, $distributionList, $distributionRecord);
            $this->getEm()->persist($cr);

            if ($i % 100 == 0) {
                $this->getEm()->flush();
            }
        }

        $this->getEm()->flush();
    }

    /**
     * @param $campaign
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws OptimisticLockException
     */
    public function processCampaingRecords($campaign)
    {
        try {
            $campaignRecords = $this->getEm()->getRepository(CampaignRecord::class)->findBy([
                'campaign' => $this->getEm()->getReference(Campaign::class, $campaign->getId())
            ]);
            /** @var $campaign Campaign */
            $campaignObjects = new CampaignObjects($campaign);

            for ($i = 0; $i < count($campaignRecords); $i++) {
                /** @var $campaignRecord CampaignRecord */
                $campaignRecord = $campaignRecords[$i];
                $distributionRecord = $campaignRecord->getDistributionRecord();
                $result = $this->processCampaingRecord($campaignObjects, $distributionRecord);
                $state = $result ? Constants::CAMPAIGN_RECORD_PROCESS : Constants::CAMPAIGN_RECORD_FAILED;
                $campaignRecord->setState($this->getEm()->getReference(CampaignRecordState::class, $state));
                $campaignRecord->setSentDate(new \DateTime());
                $this->getEm()->persist($campaignRecord);
                if ($i % 100 == 0) {
                    $this->getEm()->flush();
                }
                usleep($this->getModuleOptions()->getDelayBetweenEmails() * 1000);
            }
            $this->getEm()->flush();
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    private function processCampaingRecord(CampaignObjects $campaignObjects, DistributionRecord $distributionRecord)
    {
        return $this->getCampaignMailService()->with($campaignObjects)->sendEmail($distributionRecord);
    }

    /**
     * @param $distributionList
     * @return array|object[]
     * @throws \Doctrine\ORM\ORMException
     */
    private function getDistributionRecords($distributionList)
    {
        $distributionRecords = $this->getEm()->getRepository(DistributionRecord::class)->findBy([
            'distributionList' => $this->getEm()->getReference(DistributionList::class, $distributionList->getId()),
            'subscription' => Constants::SUBSCRIPTION_ACTIVE
        ]);
        return $distributionRecords;
    }

    /**
     * @param $campaign
     * @param $distributionList
     * @param $distributionRecord
     * @return CampaignRecord
     * @throws \Doctrine\ORM\ORMException
     */
    private function createCampaignRecord($campaign, $distributionList, $distributionRecord)
    {
        $cr = new CampaignRecord();
        $cr->setDistributionList($this->getEm()->getReference(DistributionList::class, $distributionList->getId()))
            ->setCampaign($this->getEm()->getReference(Campaign::class, $campaign->getId()))
            ->setDistributionRecord($this->getEm()->getReference(DistributionRecord::class, $distributionRecord->getId()))
            ->setCreatedDate(new \DateTime())
            ->setState($this->getEm()->getReference(CampaignRecordState::class, Constants::CAMPAIGN_RECORD_NEW));
        return $cr;
    }


}
