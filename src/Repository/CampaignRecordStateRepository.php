<?php

namespace ZfMetal\EmailCampaigns\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CampaignRecordStateRepository
 */
class CampaignRecordStateRepository extends EntityRepository
{

    public function save(\ZfMetal\EmailCampaigns\Entity\CampaignRecordState $entity)
    {
        $this->getEntityManager()->persist($entity); $this->getEntityManager()->flush();
    }

    public function remove(\ZfMetal\EmailCampaigns\Entity\CampaignRecordState $entity)
    {
        $this->getEntityManager()->remove($entity); $this->getEntityManager()->flush();
    }


}

