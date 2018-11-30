<?php

return [
    'zf-metal-datagrid.custom' => [
        'ZfMetal\EmailCampaigns-entity-distributionlist' => [
            'gridId' => 'zfmdg_DistributionList',
            'sourceConfig' => [
                'type' => 'doctrine',
                'doctrineOptions' => [
                    'entityName' => \ZfMetal\EmailCampaigns\Entity\DistributionList::class,
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
                'columns' => 'one',
                'style' => 'vertical',
                'groups' => [

                ],
            ],
            'columnsConfig' => [
                'id' => [
                    'displayName' => 'ID',
                    'priority' => 10
                ],
                'nameList' => [
                    'displayName' => 'Nombre',
                    'priority' => 20
            ],
                'originEmail' => [
                    'displayName' => 'Email Remitente',
                    'priority' => 30
                ],
                'originName' => [
                    'displayName' => 'Nombre Remitente',
                    'priority' => 40
                ],
                'records' => [
                    'hidden' => true,
                ],
            ],
            'crudConfig' => [
                'enable' => true,
                'displayName' => null,
                'add' => [
                    'enable' => true,
                    'class' => '',
                    'value' => '<a data-toggle="tooltip" class="btn btn-primary btn-sm glyphicon glyphicon-plus cursor-pointer" title="Nuevo" href="new-edit"></a>',
                ],
                'edit' => [
                    'enable' => true,
                    'class' => '',
                    'value' => '<a data-toggle="tooltip" class="glyphicon glyphicon-edit cursor-pointer" title="Nuevo" href="new-edit/{{id}}"></a>',
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
