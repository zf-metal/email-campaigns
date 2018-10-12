<?php

namespace ZfMetal\EmailCampaigns\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * DistributionListRepository
 */
class DistributionListRepository extends EntityRepository
{

    public function save(\ZfMetal\EmailCampaigns\Entity\DistributionList $entity)
    {
        $this->getEntityManager()->persist($entity); $this->getEntityManager()->flush();
    }

    public function remove(\ZfMetal\EmailCampaigns\Entity\DistributionList $entity)
    {
        $this->getEntityManager()->remove($entity); $this->getEntityManager()->flush();
    }


}

