<?php

namespace ZfMetal\EmailCampaigns\Factory\Service;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfMetal\EmailCampaigns\Service\CampaignMailService;
use ZfMetal\EmailCampaigns\Service\CampaignRecordService;
use ZfMetal\EmailCampaigns\Service\CampaignService;

class CampaignRecordServiceFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return object|CampaignRecordService
     */
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get("doctrine.entitymanager.orm_default");
        $campaignRecordService = $container->get(CampaignMailService::class);
        $moduleOptions = $container->get('ZfMetal\EmailCampaigns.options');
        return new CampaignRecordService($em, $campaignRecordService, $moduleOptions);
    }


}