<?php

namespace ZfMetal\EmailCampaigns\Repository;

use Doctrine\ORM\EntityRepository;

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


}

