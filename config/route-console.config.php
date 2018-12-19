<?php

return [
    'console' => array(
        'router' => array(
            'routes' => array(
                'activate_campaign' => array(
                    'options' => array(
                        // add [ and ] if optional ( ex : [<doname>] )
                        'route' => 'activate_campaign',
                        'defaults' => array(
                            'controller' => \ZfMetal\EmailCampaigns\Controller\ConsoleCampaignController::class,
                            'action' => 'activeNewCampaigns'
                        ),
                    ),
                ),
                'process_campaign' => array(
                    'options' => array(
                        // add [ and ] if optional ( ex : [<doname>] )
                        'route' => 'process_campaign',
                        'defaults' => array(
                            'controller' => \ZfMetal\EmailCampaigns\Controller\ConsoleCampaignController::class,
                            'action' => 'processActivateCampaigns'
                        ),
                    ),
                ),
                'initialize_zfec_module' => array(
                    'options' => array(
                        // add [ and ] if optional ( ex : [<doname>] )
                        'route' => 'initialize_zfec_module',
                        'defaults' => array(
                            'controller' => \ZfMetal\EmailCampaigns\Controller\InitializeController::class,
                            'action' => 'initialize'
                        ),
                    ),
                ),
                'activeNewCampaigns' => array(
                    'options' => array(
                        // add [ and ] if optional ( ex : [<doname>] )
                        'route' => 'activeNewCampaigns',
                        'defaults' => array(
                            'controller' => \ZfMetal\EmailCampaigns\Controller\ConsoleCampaignController::class,
                            'action' => 'activeNewCampaigns'
                        ),
                    ),
                ),
                'processActivateCampaigns' => array(
                    'options' => array(
                        // add [ and ] if optional ( ex : [<doname>] )
                        'route' => 'processActivateCampaigns',
                        'defaults' => array(
                            'controller' => \ZfMetal\EmailCampaigns\Controller\ConsoleCampaignController::class,
                            'action' => 'processActivateCampaigns'
                        ),
                    ),
                ),
            ),
        ),
    ),
];
