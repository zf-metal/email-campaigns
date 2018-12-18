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
            \ZfMetal\EmailCampaigns\Controller\InitializeController::class => \ZfMetal\EmailCampaigns\Factory\Controller\InitializeControllerFactory::class,
            \ZfMetal\EmailCampaigns\Controller\PictureRepositoryController::class => \ZfMetal\EmailCampaigns\Factory\Controller\PictureRepositoryControllerFactory::class,
            \ZfMetal\EmailCampaigns\Controller\TemplateGeneratorController::class => \ZfMetal\EmailCampaigns\Factory\Controller\TemplateGeneratorControllerFactory::class,
            \ZfMetal\EmailCampaigns\Controller\ConsoleCampaignController::class => \ZfMetal\EmailCampaigns\Factory\Controller\ConsoleCampaignControllerFactory::class,
        ),
    ),
);
