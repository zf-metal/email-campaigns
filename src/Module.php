<?php

namespace ZfMetal\EmailCampaigns;

use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;


/**
 * Module
 */
class Module implements
    ConsoleBannerProviderInterface,
    ConsoleUsageProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getConsoleBanner(Console $console)
    {
        return "Email Campaign Module";
    }

    /**
     * This method is defined in ConsoleUsageProviderInterface
     */
    public function getConsoleUsage(Console $console)
    {
        return [
            'activate_campaign' => 'Activate Campaigns',
            'process_campaign' => 'Process Campaigns',
        ];
    }


}
