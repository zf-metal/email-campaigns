<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'ZfMetal\EmailCampaigns.options' => \ZfMetal\EmailCampaigns\Factory\Options\ModuleOptionsFactory::class,
            \ZfMetal\EmailCampaigns\Service\CampaignService::class => \ZfMetal\EmailCampaigns\Factory\Service\CampaignServiceFactory::class,
            \ZfMetal\EmailCampaigns\Service\CampaignRecordService::class => \ZfMetal\EmailCampaigns\Factory\Service\CampaignRecordServiceFactory::class,
            \ZfMetal\EmailCampaigns\Service\CampaignMailService::class => \ZfMetal\EmailCampaigns\Factory\Service\CampaignMailServiceFactory::class
        ),
    ),
);