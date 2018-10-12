<?php

namespace ZfMetal\EmailCampaigns\Factory\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * UnsubscribeControllerFactory
 */
class UnsubscribeControllerFactory implements FactoryInterface
{

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $container->get("doctrine.entitymanager.orm_default");
        return new \ZfMetal\EmailCampaigns\Controller\UnsubscribeController($em);
    }


}

