<?php

namespace ZfMetal\EmailCampaigns\Factory\Service;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfMetal\EmailCampaigns\Service\CampaignRecordService;
use ZfMetal\EmailCampaigns\Service\CampaignService;

class CampaignServiceFactory implements FactoryInterface
{

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get("doctrine.entitymanager.orm_default");
        $campaignRecordService = $container->get(CampaignRecordService::class);
        return new CampaignService($em, $campaignRecordService);
    }


}