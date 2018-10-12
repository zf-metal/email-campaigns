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
                        'route' => 'ZfMetal/EmailCampaigns/DistributionList/Grid',
                    ],
                    [
                        'label' => 'Templates',
                        'detail' => '',
                        'icon' => '',
                        'route' => 'ZfMetal/EmailCampaigns/Template/Grid',
                    ],
                    [
                        'label' => 'Subscribers',
                        'detail' => '',
                        'icon' => '',
                        'route' => 'ZfMetal/EmailCampaigns/DistributionRecord/Grid',
                    ],
                    [
                        'label' => 'Campaigns',
                        'detail' => '',
                        'icon' => '',
                        'route' => 'ZfMetal/EmailCampaigns/Campaign/Grid',
                    ],
                    [
                        'label' => 'Campaigns Records',
                        'detail' => '',
                        'icon' => '',
                        'route' => 'ZfMetal/EmailCampaigns/CampaignRecord/Grid',
                    ],
                ],
            ],
        ],
    ],
];