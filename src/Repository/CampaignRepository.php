<?php

namespace ZfMetal\EmailCampaigns\Repository;

use Doctrine\ORM\EntityRepository;
use ZfMetal\EmailCampaigns\Constants;
use ZfMetal\EmailCampaigns\Entity\Campaign;
use ZfMetal\EmailCampaigns\Entity\CampaignState;

/**
 * CampaignRepository
 */
class CampaignRepository extends EntityRepository
{

    public function save(\ZfMetal\EmailCampaigns\Entity\Campaign $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function remove(\ZfMetal\EmailCampaigns\Entity\Campaign $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    public function getNewCampaigns($limit = 10)
    {
        $campaigns = $this->findCampaignsWithStateAndLimit(Constants::CAMPAIGN_NEW, $limit);
        $this->updateCampaignsWithState($campaigns, Constants::CAMPAIGN_TAKED);

        return $campaigns;
    }

    public function getActivatedCampaigns($limit = 10)
    {
        $campaigns = $this->findCampaignsWithStateAndLimit(Constants::CAMPAIGN_ACTIVATED, $limit);
        $this->updateCampaignsWithState($campaigns, Constants::CAMPAIGN_IN_PROCESS);

        return $campaigns;
    }

    /**
     * @param $limit
     * @param $state
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
    private function findCampaignsWithStateAndLimit($state, $limit)
    {
        $campaigns = $this->getEntityManager()->createQueryBuilder()
            ->select('c')
            ->from(Campaign::class, 'c')
            ->where('c.state = :state')
            ->andWhere('c.paused = :paused') //Campañas que no esten pausadas
            ->setParameter('state', $this->getEntityManager()->getReference(CampaignState::class, $state))
            ->setParameter('paused',false)
            ->setMaxResults($limit)
            ->getQuery()->getResult();
        return $campaigns;
    }

    /**
     * @param $campaigns
     * @throws \Doctrine\ORM\ORMException
     */
    private function updateCampaignsWithState($campaigns, $state)
    {
        for ($i = 0; $i < count($campaigns); $i++) {
            $campaigns[$i]->setState($this->getEntityManager()->getReference(CampaignState::class, $state));
            $this->getEntityManager()->persist($campaigns[$i]);
        }
        $this->getEntityManager()->flush();
    }
}
