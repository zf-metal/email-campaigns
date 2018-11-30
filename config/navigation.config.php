<?php

return [
    'navigation' => [
        'default' => [
            [
                'label' => 'Campañas de Email',
                'detail' => '',
                'icon' => '',
                'uri' => '',
                'pages' => [
                    [
                        'label' => 'Campañas',
                        'detail' => '',
                        'icon' => '',
                        'route' => 'ZfMetal_EmailCampaigns/Campaign/Grid',
                    ],
                    [
                        'label' => 'Listas',
                        'detail' => '',
                        'icon' => '',
                        'route' => 'ZfMetal_EmailCampaigns/DistributionList/Grid',
                    ],
                    [
                        'label' => 'Imagenes',
                        'detail' => '',
                        'icon' => '',
                        'route' => 'ZfMetal_EmailCampaigns/PictureRepository/Grid',
                    ],
                    [
                        'label' => 'Templates',
                        'detail' => '',
                        'icon' => '',
                        'route' => 'ZfMetal_EmailCampaigns/Template/Grid',
                    ],
                    [
                        'label' => 'Generador de Template',
                        'detail' => '',
                        'icon' => '',
                        'route' => 'ZfMetal_EmailCampaigns/TemplateGenerator/Index',
                    ],
                ],
            ],
        ],
    ],
];
