<?php

namespace ZfMetal\EmailCampaigns\Factory\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * TemplateGeneratorControllerFactory
 *
 *
 *
 * @author
 * @license
 * @link
 */
class TemplateGeneratorControllerFactory implements FactoryInterface
{

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        return new \ZfMetal\EmailCampaigns\Controller\TemplateGeneratorController();
    }


}
