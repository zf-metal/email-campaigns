<?php

namespace ZfMetal\EmailCampaigns\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * CampaignController
 */
class InitializeController extends AbstractActionController
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em = null;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function initializeAction()
    {
        $campaignRecordStates = [
            ['id' => 1, 'name' => 'new', 'web_name' => 'New'],
            ['id' => 2, 'name' => 'processed', 'web_name' => 'Processed'],
            ['id' => 3, 'name' => 'confirmed', 'web_name' => 'Confirmed'],
            ['id' => 4, 'name' => 'failed', 'web_name' => 'Failed']
        ];
        $campaignStates = [
            ['id' => 1, 'name' => 'new', 'web_name' => 'New'],
            ['id' => 2, 'name' => 'taked', 'web_name' => 'Taked'],
            ['id' => 3, 'name' => 'activated', 'web_name' => 'Activated'],
            ['id' => 4, 'name' => 'inProgress', 'web_name' => 'In Progress'],
            ['id' => 5, 'name' => 'finished', 'web_name' => 'Finished'],
            ['id' => 6, 'name' => 'failed', 'web_name' => 'Failed'],
            ['id' => 7, 'name' => 'paused', 'web_name' => 'Paused']
        ];

        for ($i = 0; $i < count($campaignRecordStates); $i++) {
            $c = $campaignRecordStates[$i];
            $campaignRecordState = $this->getEm()
                ->getRepository(\ZfMetal\EmailCampaigns\Entity\CampaignRecordState::class)
                ->find($c['id']);
            if (!$campaignRecordState) {
                $campaignRecordState = new \ZfMetal\EmailCampaigns\Entity\CampaignRecordState();
            }
            $campaignRecordState
                ->setId($c['id'])
                ->setName($c['name'])
                ->setWebName($c['web_name']);

            $this->getEm()->persist($campaignRecordState);
        }

        for ($i = 0; $i < count($campaignStates); $i++) {
            $c = $campaignStates[$i];
            $campaignState = $this->getEm()
                ->getRepository(\ZfMetal\EmailCampaigns\Entity\CampaignState::class)
                ->find($c['id']);
            if (!$campaignState) {
                $campaignState = new \ZfMetal\EmailCampaigns\Entity\CampaignState();
            }
            $campaignState
                ->setId($c['id'])
                ->setName($c['name'])
                ->setWebName($c['web_name']);

            $this->getEm()->persist($campaignState);
        }

        $this->getEm()->flush();


        $this->moveExampleFile();


        return 'OK' . PHP_EOL;
    }

    /**
     * Get the value of Em
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEm()
    {
        return $this->em;
    }


    private function moveExampleFile()
    {

        if (!file_exists('./public/files/')) {
            $result = mkdir('./public/files/', 0755, true);
            if (!$result) {
                throw new \Exception('Permission denied to create the folder: ' . './public/files/');
            }
        }

        $result = copy(__DIR__ . '/../../data/distributionListExample.csv', './public/files/distributionListExample.csv');

        if (!$result) {
            throw new \Exception("Falla al mover el ejemplo");
        }
    }
}
