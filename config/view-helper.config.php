<?php

return array(
    'view_helpers' => array(
        'factories' => array(
            'ZfMetal\EmailCampaignsOptions' => \ZfMetal\EmailCampaigns\Factory\Helper\View\OptionsFactory::class,
        ),
        'invokables' => array(
            \ZfMetal\Datagrid\View\Helper\Pause::class => \ZfMetal\Datagrid\View\Helper\Pause::class,
            'Pause' => \ZfMetal\Datagrid\View\Helper\Pause::class
        )
    ),
);