<?php

namespace ZfMetal\EmailCampaigns\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TemplateRepository
 */
class TemplateRepository extends EntityRepository
{

    public function save(\ZfMetal\EmailCampaigns\Entity\Template $entity)
    {
        $this->getEntityManager()->persist($entity); $this->getEntityManager()->flush();
    }

    public function remove(\ZfMetal\EmailCampaigns\Entity\Template $entity)
    {
        $this->getEntityManager()->remove($entity); $this->getEntityManager()->flush();
    }


}

