<?php

namespace ZfMetal\EmailCampaigns\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CampaignRecordRepository
 */
class CampaignRecordRepository extends EntityRepository
{

    public function save(\ZfMetal\EmailCampaigns\Entity\CampaignRecord $entity)
    {
        $this->getEntityManager()->persist($entity); $this->getEntityManager()->flush();
    }

    public function remove(\ZfMetal\EmailCampaigns\Entity\CampaignRecord $entity)
    {
        $this->getEntityManager()->remove($entity); $this->getEntityManager()->flush();
    }


}

