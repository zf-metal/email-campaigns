<?php

$setting = array_merge_recursive(
include "controller.config.php",
include "doctrine.config.php",
include "navigation.config.php",
include "option.config.php",
include "plugins.config.php",
include "route-console.config.php",
include "route.config.php",
include "services.config.php",
include "validator.config.php",
include "view-helper.config.php",
include "view.config.php",
include "zfm-datagrid.campaign-record.config.php",
include "zfm-datagrid.campaign.config.php",
include "zfm-datagrid.distribution-list.config.php",
include "zfm-datagrid.distribution-record.config.php",
include "zfm-datagrid.template.config.php"
);

return $setting;
