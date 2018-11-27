<?php

namespace ZfMetal\EmailCampaigns\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * PictureRepositoryController
 *
 *
 *
 * @author
 * @license
 * @link
 */
class PictureRepositoryController extends AbstractActionController
{

    const ENTITY = \ZfMetal\EmailCampaigns\Entity\Picture::class;

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

    public function getPictureRepository()
    {
        return $this->getEm()->getRepository(self::ENTITY);
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
        $this->grid->addExtraColumn('Link', ' <a title="Link" target="_blank" class="btn btn-primary" href="/pictures/{{file}}"> <span class="glyphicon glyphicon-download" aria-hidden="true"></span></a> ', 'right');
        $this->grid->prepare();

        return array("grid" => $this->grid);
    }


}
