<?php
namespace Test\Service;

use PHPUnit\Framework\TestCase;
use ZfMetal\EmailCampaigns\Service\CampaignService;
use ZfMetal\EmailCampaigns\Entity\Campaign;
use ZfMetal\EmailCampaigns\Constants;

class CampaignServiceTest extends TestCase {

    private $em;
    private $campaignRepository;

    public function setUp(){
        $this->em = $this->createMock(\Doctrine\ORM\EntityManager::class);
        $this->em->method('persist')->willReturn(true);
        $this->em->method('flush')->willReturn(true);
        $this->campaignRepository = $this->createMock(\ZfMetal\EmailCampaigns\Repository\CampaignRepository::class);
    }

    public function testCreateIntanceOfCampaignService(){
        $campaignService = new CampaignService($this->em);
        $this->assertInstanceOf(CampaignService::class, $campaignService);
        return $campaignService;
    }

    /**
    * @depends testCreateIntanceOfCampaignService
    */
    public function testActivateCampaign($campaignService){
        $campaigns = $this->init();
        $campaignService->setEm($this->em);
        $activeCampaignState = $this->getCampaignState(3,'ACTIVE');
        $this->em->method('getReference')->with(Constants::ENTITY_CAMPAIGN_STATE,3)->willReturn($activeCampaignState);

        $campaignService->activateCampaigns();
        $actualCampaign = $this->getCampaignsWithState($campaigns, $activeCampaignState);

        $this->assertEquals(10, count($actualCampaign));
    }

    private function getCampaignsWithState($campaigns, $state){
        $c = [];

        for($i = 0; $i < count($campaigns); $i++){
            if($campaigns[$i]->getState() == $state){
              $c[] = $campaigns[$i];
            }
        }
        return $c;
    }

    private function init($state = 1){
        $campaigns = $this->getCampaignsForProcess($state);
        $this->em->method('getRepository')->with(Constants::ENTITY_CAMPAIGN)->willReturn($this->campaignRepository);
        $this->campaignRepository->method('getNewCampaigns')->with(10)->willReturn($campaigns);
        return $campaigns;
    }

    private function getCampaignsForProcess(){
        $campaign = [];
        $newCampaignState = $this->getCampaignState(1,'New');
        for($i = 0 ; $i < 10; $i++) {
            $campaign[$i] = new Campaign();
            $campaign[$i]->setId($i + 1 );
            $campaign[$i]->setState($newCampaignState);
        }

        return $campaign;
    }

    private function getCampaignState($id,$name){
        $state = Constants::ENTITY_CAMPAIGN_STATE;
        $campaignState = new $state;
        $campaignState->setId($id);
        $campaignState->setName($name);
        $campaignState->setWebName($name);

        return $campaignState;
    }
}
