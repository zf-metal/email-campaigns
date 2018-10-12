<?php

return [
    'zf-metal-datagrid.custom' => [
        'ZfMetal\EmailCampaigns-entity-campaign' => [
            'gridId' => 'zfmdg_Campaign',
            'sourceConfig' => [
                'type' => 'doctrine',
                'doctrineOptions' => [
                    'entityName' => \ZfMetal\EmailCampaigns\Entity\Campaign::class,
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
                ],
                'distributionList' => [
                    'displayName' => 'Distribution List',
                    'type' => 'relational',
                ],
                'template' => [
                    'displayName' => 'Template',
                    'type' => 'relational',
                ],
                'createDate' => [
                    'displayName' => 'Created Date',
                    'type' => 'date',
                    'format' => 'Y-m-d H:i:s',
                ],
                'finishDate' => [
                    'displayName' => 'Finish Date',
                    'type' => 'date',
                    'format' => 'Y-m-d H:i:s',
                ],
                'state' => [
                    'displayName' => 'State',
                    'type' => 'relational',
                ],
                'records' => [
                    'hidden' => true,
                ],
                'attachedFiles' => [
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
