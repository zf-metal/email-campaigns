<?php
namespace ZfMetal\EmailCampaigns\Service;
use ZfMetal\EmailCampaigns\Constants;

class CampaignService
{
  /**
   * @var \Doctrine\ORM\EntityManager
   */
    private $em;

    public function __construct(\Doctrine\ORM\EntityManager $em){
        $this->em = $em;
    }

    public function getEm()
    {
        return $this->em;
    }

    public function setEm(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function getCampaignRepository(){
        return $this->getEm()->getRepository(Constants::ENTITY_CAMPAIGN);
    }

    public function activateCampaigns(){
        // TODO Replace 10 for Config
        $campaigns = $this->getCampaignRepository()->getNewCampaigns(10);

        for($i = 0; $i < count($campaigns); $i++){
            $this->processCampaign($campaigns[$i]);
            $campaigns[$i]->setState($this->getEm()->getReference(Constants::ENTITY_CAMPAIGN_STATE,3));
            $this->getEm()->persist($campaigns[$i]);
            $this->getEm()->flush();
        }

        return $campaigns;
    }
    private function processCampaign($campaign){
        // TODO createChampaignRecords
    }
}
