<?php

return [
    'zf-metal-datagrid.custom' => [
        'ZfMetal\EmailCampaigns-entity-template' => [
            'gridId' => 'zfmdg_Template',
            'sourceConfig' => [
                'type' => 'doctrine',
                'doctrineOptions' => [
                    'entityName' => \ZfMetal\EmailCampaigns\Entity\Template::class,
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
                    'priority' => 10
                ],
                'name' => [
                    'displayName' => 'Nombre',
                    'priority' => 20
                ],
                'file' => [
                    'displayName' => 'File',
                    'hidden'      => true
                ],
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
