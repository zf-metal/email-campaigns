<?php

namespace ZfMetal\EmailCampaigns\Factory\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * CampaignRecordControllerFactory
 */
class CampaignRecordControllerFactory implements FactoryInterface
{

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $container->get("doctrine.entitymanager.orm_default");
        /* @var $grid \ZfMetal\Datagrid\Grid */
        $grid = $container->build("zf-metal-datagrid", ["customKey" => "ZfMetal\EmailCampaigns-entity-campaignrecord"]);
        return new \ZfMetal\EmailCampaigns\Controller\CampaignRecordController($em,$grid);
    }


}

