<?php

namespace ZfMetal\EmailCampaigns\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ZfMetal\EmailCampaigns\Entity\DistributionList;

/**
 * DistributionRecordController
 */
class DistributionRecordController extends AbstractActionController
{

    const ENTITY = \ZfMetal\EmailCampaigns\Entity\DistributionRecord::class;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    public $em = null;

    /**
     * @var \ZfMetal\Datagrid\Grid
     */
    public $grid = null;

    public function getEm()
    {
        return $this->em;
    }

    public function setEm(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function getEntityRepository()
    {
        return $this->getEm()->getRepository(self::ENTITY);
    }

    public function getDistributionRecordRepository()
    {
        return $this->getEm()->getRepository(self::ENTITY);
    }

    public function getDistributionListRepository()
    {
        return $this->getEm()->getRepository(DistributionList::class);
    }

    public function __construct(\Doctrine\ORM\EntityManager $em, \ZfMetal\Datagrid\Grid $grid)
    {
        $this->em = $em;
        $this->grid = $grid;
    }

    public function getGrid()
    {
        return $this->grid;
    }

    public function setGrid(\ZfMetal\Datagrid\Grid $grid)
    {
        $this->grid = $grid;
    }

    public function gridAction()
    {
        $id = $this->params('id');
        if ($id) {

            $distributionList = $this->getDistributionListRepository()->find($id);

            if (!$distributionList) {
                throw new \Exception("Distribution List doesn't exist");
            }

            $this->grid->getCrud()->getSource()->getQb()->andWhere('u.distributionList = :id');
            $this->grid->getCrud()->getSource()->getQb()->setParameter('id', $id);
        }
        $this->grid->prepare();
        return array("grid" => $this->grid, "distributionList" => $distributionList);
    }


}
