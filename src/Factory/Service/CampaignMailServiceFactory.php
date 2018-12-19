<?php

namespace ZfMetal\EmailCampaigns\Factory\Service;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfMetal\EmailCampaigns\Service\CampaignMailService;
use ZfMetal\EmailCampaigns\Service\CampaignRecordService;
use ZfMetal\EmailCampaigns\Service\CampaignService;

class CampaignMailServiceFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return object|CampaignRecordService
     */
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $campaignRecordService = $container->get(\ZfMetal\Mail\MailManager::class);
        $moduleOptions = $container->get('ZfMetal\EmailCampaigns.options');
        return new CampaignMailService($campaignRecordService, $moduleOptions);
    }


}