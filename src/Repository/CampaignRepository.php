<?php

namespace ZfMetal\EmailCampaigns\Repository;

use Doctrine\ORM\EntityRepository;
use ZfMetal\EmailCampaigns\Constants;

/**
 * CampaignRepository
 */
class CampaignRepository extends EntityRepository
{

    public function save(\ZfMetal\EmailCampaigns\Entity\Campaign $entity)
    {
        $this->getEntityManager()->persist($entity); $this->getEntityManager()->flush();
    }

    public function remove(\ZfMetal\EmailCampaigns\Entity\Campaign $entity)
    {
        $this->getEntityManager()->remove($entity); $this->getEntityManager()->flush();
    }

    public function getNewCampaigns($limit = 10){
        $campaigns = $this->createQueryBuilder('u')
                        ->select('u')
                        ->from(Constants::ENTITY_CAMPAIGN, 'c')
                        ->where('u.state = :state')
                        ->setParameter('state', $this->getEntityManager()->getReference(Constants::ENTITY_CAMPAIGN_STATE, Constants::CAMPAIGN_NEW))
                        ->setMaxResults($limit)
                        ->getQuery()->getResult();

        for($i = 0; $i < count($campaigns); $i++){
            $campaigns[$i]->setState($this->getEntityManager()->getReference(Constants::ENTITY_CAMPAIGN_STATE, Constants::CAMPAIGN_TAKED));
            $this->getEntityManager()->persist($campaigns[$i]);
        }

        $this->getEntityManager()->flush();

        return $campaigns;
    }
}
