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
                            'controller' => \ZfMetal\EmailCampaigns\Controller\BachProcessorController::class,
                            'action' => 'activateCampaign'
                        ),
                    ),
                ),
                'process_campaign' => array(
                    'options' => array(
                        // add [ and ] if optional ( ex : [<doname>] )
                        'route' => 'process_campaign',
                        'defaults' => array(
                            'controller' => \ZfMetal\EmailCampaigns\Controller\BachProcessorController::class,
                            'action' => 'processCampaign'
                        ),
                    ),
                ),
                'test' => array(
                    'options' => array(
                        // add [ and ] if optional ( ex : [<doname>] )
                        'route' => 'test',
                        'defaults' => array(
                            'controller' => \ZfMetal\EmailCampaigns\Controller\BachProcessorController::class,
                            'action' => 'test'
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
            ),
        ),
    ),
];
