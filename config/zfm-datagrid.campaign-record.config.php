<?php

return [
    'zf-metal-datagrid.custom' => [
        'ZfMetal\EmailCampaigns-entity-campaignrecord' => [
            'gridId' => 'zfmdg_CampaignRecord',
            'sourceConfig' => [
                'type' => 'doctrine',
                'doctrineOptions' => [
                    'entityName' => \ZfMetal\EmailCampaigns\Entity\CampaignRecord::class,
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
                ],
                'campaign' => [
                    'displayName' => 'Campaign',
                    'type' => 'relational',
                    'hidden' => true
                ],
                'distributionList' => [
                    'displayName' => 'Distribution List',
                    'type' => 'relational',
                ],
                'distributionRecord' => [
                    'displayName' => 'Distribution Record',
                    'type' => 'relational',
                ],
                'template' => [
                    'displayName' => 'Template',
                    'type' => 'relational',
                ],
                'createdDate' => [
                    'displayName' => 'From',
                    'type' => 'date',
                    'format' => 'Y-m-d H:i:s',
                ],
                'sentDate' => [
                    'displayName' => 'Sent Date',
                    'type' => 'date',
                    'format' => 'Y-m-d H:i:s',
                ],
                'state' => [
                    'displayName' => 'State',
                    'type' => 'relational',
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