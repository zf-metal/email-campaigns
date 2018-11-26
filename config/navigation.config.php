<?php

return [
    'navigation' => [
        'default' => [
            [
                'label' => 'Email Campaigns',
                'detail' => '',
                'icon' => '',
                'uri' => '',
                'pages' => [
                    [
                        'label' => 'Distribution List',
                        'detail' => '',
                        'icon' => '',
                        'route' => 'ZfMetal_EmailCampaigns/DistributionList/Grid',
                    ],
                    [
                        'label' => 'Templates',
                        'detail' => '',
                        'icon' => '',
                        'route' => 'ZfMetal_EmailCampaigns/Template/Grid',
                    ],
//                    [
//                        'label' => 'Subscribers',
//                        'detail' => '',
//                        'icon' => '',
//                        'route' => 'ZfMetal_EmailCampaigns/DistributionRecord/Grid',
//                    ],
                    [
                        'label' => 'Campaigns',
                        'detail' => '',
                        'icon' => '',
                        'route' => 'ZfMetal_EmailCampaigns/Campaign/Grid',
                    ],
//                    [
//                        'label' => 'Campaigns Records',
//                        'detail' => '',
//                        'icon' => '',
//                        'route' => 'ZfMetal_EmailCampaigns/CampaignRecord/Grid',
//                    ],
                ],
            ],
        ],
    ],
];
