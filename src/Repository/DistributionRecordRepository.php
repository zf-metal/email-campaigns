<?php

namespace ZfMetal\EmailCampaigns\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * DistributionRecordRepository
 */
class DistributionRecordRepository extends EntityRepository
{

    public function save(\ZfMetal\EmailCampaigns\Entity\DistributionRecord $entity)
    {
        $this->getEntityManager()->persist($entity); $this->getEntityManager()->flush();
    }

    public function remove(\ZfMetal\EmailCampaigns\Entity\DistributionRecord $entity)
    {
        $this->getEntityManager()->remove($entity); $this->getEntityManager()->flush();
    }


}

