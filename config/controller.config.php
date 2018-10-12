<?php

return array(
    'controllers' => array(
        'factories' => array(
            \ZfMetal\EmailCampaigns\Controller\DistributionListController::class => \ZfMetal\EmailCampaigns\Factory\Controller\DistributionListControllerFactory::class,
            \ZfMetal\EmailCampaigns\Controller\TemplateController::class => \ZfMetal\EmailCampaigns\Factory\Controller\TemplateControllerFactory::class,
            \ZfMetal\EmailCampaigns\Controller\DistributionRecordController::class => \ZfMetal\EmailCampaigns\Factory\Controller\DistributionRecordControllerFactory::class,
            \ZfMetal\EmailCampaigns\Controller\CampaignController::class => \ZfMetal\EmailCampaigns\Factory\Controller\CampaignControllerFactory::class,
            \ZfMetal\EmailCampaigns\Controller\BachProcessorController::class => \ZfMetal\EmailCampaigns\Factory\Controller\BachProcessorControllerFactory::class,
            \ZfMetal\EmailCampaigns\Controller\UnsubscribeController::class => \ZfMetal\EmailCampaigns\Factory\Controller\UnsubscribeControllerFactory::class,
            \ZfMetal\EmailCampaigns\Controller\CampaignRecordController::class => \ZfMetal\EmailCampaigns\Factory\Controller\CampaignRecordControllerFactory::class,
        ),
    ),
);