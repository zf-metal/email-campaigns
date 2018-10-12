<?php

namespace ZfMetal\EmailCampaigns\Factory\Options;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * ModuleOptionsFactory
 *
 *
 *
 * @author
 * @license
 * @link
 */
class ModuleOptionsFactory implements FactoryInterface
{

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');
         return new \ZfMetal\EmailCampaigns\Options\ModuleOptions(isset($config['ZfMetal\EmailCampaigns.options']) ? $config['ZfMetal\EmailCampaigns.options'] : array());
    }


}

