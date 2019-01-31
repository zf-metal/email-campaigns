<?php

return array(
    'view_helpers' => array(
        'factories' => array(
            'ZfMetal\EmailCampaignsOptions' => \ZfMetal\EmailCampaigns\Factory\Helper\View\OptionsFactory::class,
        ),
        'invokables' => array(
            \ZfMetal\EmailCampaigns\View\Helper\Pause::class => \ZfMetal\EmailCampaigns\View\Helper\Pause::class,
            'Pause' => \ZfMetal\EmailCampaigns\View\Helper\Pause::class
        )
    ),
);