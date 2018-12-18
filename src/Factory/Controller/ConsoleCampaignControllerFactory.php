<?php
/**
 * Created by IntelliJ IDEA.
 * User: afurgeri
 * Date: 17/12/2018
 * Time: 23:10
 */

namespace ZfMetal\EmailCampaigns\Factory\Controller;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfMetal\EmailCampaigns\Controller\ConsoleCampaignController;
use ZfMetal\EmailCampaigns\Service\CampaignService;

/**
 * CampaignRecordControllerFactory
 */
class ConsoleCampaignControllerFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return object|ConsoleCampaignController
     */
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $campaignService = $container->get(CampaignService::class);
        return new ConsoleCampaignController($campaignService);
    }


}