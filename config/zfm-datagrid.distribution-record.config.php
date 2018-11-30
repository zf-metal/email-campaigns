<?php

return [
    'zf-metal-datagrid.custom' => [
        'ZfMetal\EmailCampaigns-entity-distributionrecord' => [
            'gridId' => 'zfmdg_DistributionRecord',
            'sourceConfig' => [
                'type' => 'doctrine',
                'doctrineOptions' => [
                    'entityName' => \ZfMetal\EmailCampaigns\Entity\DistributionRecord::class,
                    'entityManager' => 'doctrine.entitymanager.orm_default',
                ],
            ],
            'multi_filter_config' => [
                'enable' => true,
                'properties_disabled' => [

                ],
            ],
            'multi_search_config' => [
                'enable' => false,
                'properties_enabled' => [

                ],
            ],
            'formConfig' => [
                'columns' => \ZfMetal\Commons\Consts::COLUMNS_ONE,
                'style' => \ZfMetal\Commons\Consts::STYLE_VERTICAL,
                'groups' => [

                ],
            ],
            'columnsConfig' => [
                'id' => [
                    'displayName' => 'ID',
                    'priority' => 10,
                ],
                'distributionList' => [
                    'type' => 'relational',
                    'priority' => 20,
                    'displayName' => 'Lista'
                ],
                'firstName' => [
                    'displayName' => 'Nombre',
                ],
                'lastName' => [
                    'displayName' => 'Apellido',
                ],
                'email' => [
                    'displayName' => 'Email',
                ],
                'phone' => [
                    'displayName' => 'Telefono',
                ],
                'customerField1' => [
                    'displayName' => 'Clave1',
                    'hidden' => true
                ],
                'customerField2' => [
                    'displayName' => 'Clave2',
                    'hidden' => true
                ],
                'customerField3' => [
                    'displayName' => 'Clave3',
                    'hidden' => true
                ],
                'subscription' => [
                    'displayName' => 'Subscripcion',
                    'type' => "boolean",
                    'valueWhenTrue' => '<span class=" alert-success">Subscribed</span>',
                    'valueWhenFalse' => '<span class="alert-danger">Unsubscribed</span>'
                ]
            ],
            'crudConfig' => [
                'enable' => true,
                'displayName' => null,
                'add' => [
                    'enable' => true,
                    'class' => ' glyphicon glyphicon-plus cursor-pointer',
                    'value' => '',
                ],
                'edit' => [
                    'enable' => true,
                    'class' => ' glyphicon glyphicon-edit cursor-pointer',
                    'value' => '',
                ],
                'del' => [
                    'enable' => true,
                    'class' => ' glyphicon glyphicon-trash cursor-pointer',
                    'value' => '',
                ],
                'view' => [
                    'enable' => true,
                    'class' => ' glyphicon glyphicon-list-alt cursor-pointer',
                    'value' => '',
                ],
            ],
        ],
    ],
];
