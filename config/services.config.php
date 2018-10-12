<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'ZfMetal\EmailCampaigns.options' => \ZfMetal\EmailCampaigns\Factory\Options\ModuleOptionsFactory::class,
        ),
    ),
);