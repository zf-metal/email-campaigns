<?php

return array(
    'controller_plugins' => array(
        'factories' => array(
            \ZfMetal\EmailCampaigns\Controller\Plugin\Options::class => \ZfMetal\EmailCampaigns\Factory\Controller\Plugin\OptionsFactory::class,
        ),
        'aliases' => array(
            'emailCampaignsOptions' => \ZfMetal\EmailCampaigns\Controller\Plugin\Options::class,
        ),
    ),
);