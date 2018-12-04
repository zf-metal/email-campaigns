<?php

return [
  'ZfMetal\EmailCampaigns.options' => [
    'url_domain'            => null,
    'search_campaign_limit' => 5,
    'path_attached_files'   => './files',
    'distribution_record_fields' => [
      '@nombre'   => 'firstName',
      '@apellido' => 'lastName',
      '@email'    => 'email',
      '@telefono' => 'phone',
      '@c1'       => 'customerField1',
      '@c2'       => 'customerField2',
      '@c3'       => 'customerField3',
    ]
  ]
];
