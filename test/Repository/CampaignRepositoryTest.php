<?php
/**
 * Created by IntelliJ IDEA.
 * User: afurgeri
 * Date: 14/12/2018
 * Time: 20:54
 */

namespace Test\Repository;

use Doctrine\ORM\EntityManager;
use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;
use ZfMetal\EmailCampaigns\Constants;
use ZfMetal\EmailCampaigns\Entity\Campaign;
use ZfMetal\EmailCampaigns\Entity\CampaignRecord;
use ZfMetal\EmailCampaigns\Entity\CampaignState;
use ZfMetal\EmailCampaigns\Entity\DistributionList;
use ZfMetal\EmailCampaigns\Entity\DistributionRecord;
use ZfMetal\EmailCampaigns\Entity\Template;
use ZfMetal\EmailCampaigns\Repository\CampaignRepository;

class CampaignRepositoryTest extends AbstractConsoleControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../config/application.config.php'
        );

        parent::setUp();
        $this->clearData();
    }

    public function tearDown()
    {
        $this->clearData();
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    /**
     * @return EntityManager
     */
    public function getEm()
    {
        return $this->getApplicationServiceLocator()->get(EntityManager::class);
    }

    /**
     * @return CampaignRepository
     */
    public function getCampaignRepository()
    {
        return $this->getEm()->getRepository(Campaign::class);
    }


    private function clearData()
    {
        $this->getEm()->createQueryBuilder()->delete(CampaignRecord::class, 'c')->getQuery()->execute();
        $this->getEm()->createQueryBuilder()->delete(Campaign::class, 'c')->getQuery()->execute();
        $this->getEm()->createQueryBuilder()->delete(DistributionRecord::class, 'c')->getQuery()->execute();
        $this->getEm()->createQueryBuilder()->delete(DistributionList::class, 'c')->getQuery()->execute();
        $this->getEm()->createQueryBuilder()->delete(Template::class, 'c')->getQuery()->execute();
    }

    private function createCampaignsWithState($state)
    {
        $distrubutionList = $this->createDistributionList();

        $template = $this->createTemplate();

        for ($i = 0; $i < 10; $i++) {
            $c = new Campaign();
            $c->setId($i + 1);
            $c->setState($this->getEm()->getReference(CampaignState::class, $state));
            $c->setDistributionList($distrubutionList);
            $c->setTemplate($template);
            $c->setCreateDate(new \DateTime());
            $this->getEm()->persist($c);
        }

        $this->getEm()->flush();
    }

    /**
     * @return DistributionList
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function createDistributionList()
    {
        $distrubutionList = new DistributionList();
        $distrubutionList->setId(1);
        $distrubutionList->setNameList("Test");
        $distrubutionList->setOriginName('Origin');
        $distrubutionList->setOriginEmail("origin@f.com");

        $this->getEm()->persist($distrubutionList);
        $this->getEm()->flush();
        return $distrubutionList;
    }

    /**
     * @return Template
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function createTemplate()
    {
        $template = new Template();
        $template->setId(1);
        $template->setFile('/tmp/file');
        $template->setName('Template');
        $this->getEm()->persist($template);
        $this->getEm()->flush();
        return $template;
    }

    public function testGetNewCampaigns()
    {
        $this->createCampaignsWithState(Constants::CAMPAIGN_NEW);
        $campaigs = $this->getCampaignRepository()->getNewCampaigns(2);
        $this->assertEquals(2, count($campaigs));

        $campaigs2 = $this->getCampaignRepository()->getNewCampaigns(5);
        $this->assertEquals(5, count($campaigs2));
    }

    public function testGetActivatedCampaigns()
    {
        $this->createCampaignsWithState(Constants::CAMPAIGN_ACTIVATED);
        $campaigs = $this->getCampaignRepository()->getActivatedCampaigns(2);
        $this->assertEquals(2, count($campaigs));

        $campaigs2 = $this->getCampaignRepository()->getActivatedCampaigns(5);
        $this->assertEquals(5, count($campaigs2));
    }

}