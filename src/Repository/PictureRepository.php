<?php

namespace ZfMetal\EmailCampaigns\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PictureRepository
 *
 *
 *
 * @author
 * @license
 * @link
 */
class PictureRepository extends EntityRepository
{

    public function save(\ZfMetal\EmailCampaigns\Entity\Picture $entity)
    {
        $this->getEntityManager()->persist($entity); $this->getEntityManager()->flush();
    }

    public function remove(\ZfMetal\EmailCampaigns\Entity\Picture $entity)
    {
        $this->getEntityManager()->remove($entity); $this->getEntityManager()->flush();
    }


}
