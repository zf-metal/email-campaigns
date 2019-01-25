<?php

namespace ZfMetal\EmailCampaigns\Repository;

use Doctrine\ORM\EntityRepository;
use ZfMetal\EmailCampaigns\Constants;
use ZfMetal\EmailCampaigns\Entity\CampaignRecord;

/**
 * CampaignRecordRepository
 */
class CampaignRecordRepository extends EntityRepository
{

    public function save(\ZfMetal\EmailCampaigns\Entity\CampaignRecord $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function remove(\ZfMetal\EmailCampaigns\Entity\CampaignRecord $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    public function findNewByCampaign($campaignId, $limit)
    {

        return $this->findBy(
            [
                'campaign' => $campaignId,
                'state' => Constants::CAMPAIGN_RECORD_NEW
            ],
            null,
            $limit
        );

    }

    public function countNewByCampaign($campaignId)
    {

        $qb = $this->getEntityManager()->createQueryBuilder('u');
        
        $qb->select('count(u.id)')
            ->from(CampaignRecord::class, 'u')
            ->where('u.campaign = :campaignId')
            ->andWhere('u.state = :state')
            ->setParameter('campaignId', $campaignId)
            ->setParameter('state', Constants::CAMPAIGN_RECORD_NEW);

        return $qb->getQuery()->getSingleScalarResult();
    }

}

