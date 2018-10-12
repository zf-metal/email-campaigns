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
            ),
        ),
    ),
];
