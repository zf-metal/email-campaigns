<?php

namespace ZfMetal\EmailCampaigns\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * AttachedFilesRepository
 */
class AttachedFilesRepository extends EntityRepository
{

    public function save(\ZfMetal\EmailCampaigns\Entity\AttachedFiles $entity)
    {
        $this->getEntityManager()->persist($entity); $this->getEntityManager()->flush();
    }

    public function remove(\ZfMetal\EmailCampaigns\Entity\AttachedFiles $entity)
    {
        $this->getEntityManager()->remove($entity); $this->getEntityManager()->flush();
    }


}

