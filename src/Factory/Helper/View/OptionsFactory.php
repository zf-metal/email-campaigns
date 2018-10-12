<?php

namespace ZfMetal\EmailCampaigns\Factory\Helper\View;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * OptionsFactory
 */
class OptionsFactory implements FactoryInterface
{

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $servicio = $container->get('ZfMetal\EmailCampaigns.options');
        return new \ZfMetal\EmailCampaigns\Helper\View\Options($servicio);
    }


}

