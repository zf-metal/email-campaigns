<?php

return [
    'router' => [
        'routes' => [
            'ZfMetal_EmailCampaigns' => [
                'mayTerminate' => false,
                'options' => [
                    'route' => '/email-campaigns',
                    'defaults' => [
                        'controller' => \ZfMetal\EmailCampaigns\Controller\DistributionListController::CLASS,
                        'action' => 'grid',
                    ],
                ],
                'type' => 'Literal',
                'child_routes' => [
                    'DistributionList' => [
                        'mayTerminate' => false,
                        'options' => [
                            'route' => '/distribution-list',
                            'defaults' => [
                                'controller' => \ZfMetal\EmailCampaigns\Controller\DistributionListController::CLASS,
                                'action' => 'grid',
                            ],
                        ],
                        'type' => 'Literal',
                        'child_routes' => [
                            'Grid' => [
                                'mayTerminate' => true,
                                'options' => [
                                    'route' => '/grid',
                                    'defaults' => [
                                        'controller' => \ZfMetal\EmailCampaigns\Controller\DistributionListController::CLASS,
                                        'action' => 'grid',
                                    ],
                                ],
                                'type' => 'Segment',
                            ],
                            'NewEdit' => [
                                'mayTerminate' => true,
                                'options' => [
                                    'route' => '/new-edit[/:id]',
                                    'defaults' => [
                                        'controller' => \ZfMetal\EmailCampaigns\Controller\DistributionListController::CLASS,
                                        'action' => 'newEdit',
                                    ],
                                ],
                                'type' => 'Segment',
                            ],
                        ],
                    ],
                    'Template' => [
                        'mayTerminate' => false,
                        'options' => [
                            'route' => '/template',
                            'defaults' => [
                                'controller' => \ZfMetal\EmailCampaigns\Controller\TemplateController::CLASS,
                                'action' => 'grid',
                            ],
                        ],
                        'type' => 'Literal',
                        'child_routes' => [
                            'Grid' => [
                                'mayTerminate' => true,
                                'options' => [
                                    'route' => '/grid',
                                    'defaults' => [
                                        'controller' => \ZfMetal\EmailCampaigns\Controller\TemplateController::CLASS,
                                        'action' => 'grid',
                                    ],
                                ],
                                'type' => 'Segment',
                            ],
                        ],
                    ],
                    'DistributionRecord' => [
                        'mayTerminate' => false,
                        'options' => [
                            'route' => '/distribution-record',
                            'defaults' => [
                                'controller' => \ZfMetal\EmailCampaigns\Controller\DistributionRecordController::CLASS,
                                'action' => 'grid',
                            ],
                        ],
                        'type' => 'Literal',
                        'child_routes' => [
                            'Grid' => [
                                'mayTerminate' => true,
                                'options' => [
                                    'route' => '/grid',
                                    'defaults' => [
                                        'controller' => \ZfMetal\EmailCampaigns\Controller\DistributionRecordController::CLASS,
                                        'action' => 'grid',
                                    ],
                                ],
                                'type' => 'Segment',
                            ],
                        ],
                    ],
                    'Campaign' => [
                        'mayTerminate' => false,
                        'options' => [
                            'route' => '/campaign',
                            'defaults' => [
                                'controller' => \ZfMetal\EmailCampaigns\Controller\CampaignController::CLASS,
                                'action' => 'grid',
                            ],
                        ],
                        'type' => 'Literal',
                        'child_routes' => [
                            'Grid' => [
                                'mayTerminate' => true,
                                'options' => [
                                    'route' => '/grid',
                                    'defaults' => [
                                        'controller' => \ZfMetal\EmailCampaigns\Controller\CampaignController::CLASS,
                                        'action' => 'grid',
                                    ],
                                ],
                                'type' => 'Segment',
                            ],
                            'NewEdit' => [
                                'mayTerminate' => true,
                                'options' => [
                                    'route' => '/new-edit[/:id]',
                                    'defaults' => [
                                        'controller' => \ZfMetal\EmailCampaigns\Controller\CampaignController::CLASS,
                                        'action' => 'newEdit',
                                    ],
                                ],
                                'type' => 'Segment',
                            ],
                        ],
                    ],
                    'Unsubscribe' => [
                        'mayTerminate' => false,
                        'options' => [
                            'route' => '/unsubscribe',
                            'defaults' => [
                                'controller' => \ZfMetal\EmailCampaigns\Controller\UnsubscribeController::CLASS,
                                'action' => 'unsubscribe',
                            ],
                        ],
                        'type' => 'Literal',
                        'child_routes' => [
                            'Unsubscribe' => [
                                'mayTerminate' => true,
                                'options' => [
                                    'route' => '/:list/:subscribed',
                                    'constraints' => [
                                        'list' => '[0-9]+',
                                        'subscribed' => '[0-9]+',
                                    ],
                                    'defaults' => [
                                        'controller' => \ZfMetal\EmailCampaigns\Controller\UnsubscribeController::CLASS,
                                        'action' => 'unsubscribe',
                                    ],
                                ],
                                'type' => 'Segment',
                            ],
                            'Confirmation' => [
                                'mayTerminate' => true,
                                'options' => [
                                    'route' => '/confirmation',
                                    'defaults' => [
                                        'controller' => \ZfMetal\EmailCampaigns\Controller\UnsubscribeController::CLASS,
                                        'action' => 'confirmation',
                                    ],
                                ],
                                'type' => 'Segment',
                            ],
                        ],
                    ],
                    'CampaignRecord' => [
                        'mayTerminate' => false,
                        'options' => [
                            'route' => '/campaign-record',
                            'defaults' => [
                                'controller' => \ZfMetal\EmailCampaigns\Controller\CampaignRecordController::CLASS,
                                'action' => 'grid',
                            ],
                        ],
                        'type' => 'Literal',
                        'child_routes' => [
                            'Grid' => [
                                'mayTerminate' => true,
                                'options' => [
                                    'route' => '/grid',
                                    'defaults' => [
                                        'controller' => \ZfMetal\EmailCampaigns\Controller\CampaignRecordController::CLASS,
                                        'action' => 'grid',
                                    ],
                                ],
                                'type' => 'Segment',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
