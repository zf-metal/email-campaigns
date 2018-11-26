<?php

namespace ZfMetal\EmailCampaigns\Factory\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfMetal\Mail\MailManager;

/**
 * BachProcessorControllerFactory
 */
class BachProcessorControllerFactory implements FactoryInterface
{

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $container->get("doctrine.entitymanager.orm_default");
        $mailManager = $container->get(MailManager::class);
        return new \ZfMetal\EmailCampaigns\Controller\BachProcessorController($em,$mailManager);
    }


}

