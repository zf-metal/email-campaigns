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
                    'priority' => 10
                ],
                'distributionList' => [
                    'displayName' => 'Lista',
                    'type' => 'relational',
                    'priority' => 20
                ],
                'template' => [
                    'displayName' => 'Template',
                    'type' => 'relational',
                    'priority' => 30
                ],
                'createDate' => [
                    'displayName' => 'Creado',
                    'type' => 'date',
                    'format' => 'Y-m-d H:i:s',
                    'priority' => 40
                ],
                'finishDate' => [
                    'displayName' => 'Finalizado',
                    'type' => 'date',
                    'format' => 'Y-m-d H:i:s',
                    'priority' => 40
                ],
                'state' => [
                    'displayName' => 'Estado',
                    'type' => 'relational',
                    'field'=> 'webName',
                    'priority' => 12
                ],
                'subject' => [
                    'displayName' => 'Asunto',
                    'priority' => 15
                ],
                'records' => [
                    'hidden' => true,
                ],
                'attachedFiles' => [
                    'displayName' => 'Adjuntos',
                    'type' => 'relational',
                    'reloationalId' => 'campaign',
                    'reloationalEntity' => \ZfMetal\EmailCampaigns\Entity\AttachedFiles::class,
                    'oneToMany' => true,
                    'field' => 'file',
                    'hidden' => false,
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
                    'enable' => false,
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
