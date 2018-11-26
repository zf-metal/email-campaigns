<?php

namespace ZfMetal\EmailCampaigns\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ZfMetal\Mail\MailManager;

class BachProcessorController extends AbstractActionController
{

    const ENTITY = \ZfMetal\EmailCampaigns\Entity\Campaign::class;
    const CAMPAIGN_NEW            = 1;
    const CAMPAIGN_TAKED          = 2;
    const CAMPAIGN_ACTIVATED      = 3;
    const CAMPAIGN_IN_PROCESS     = 4;
    const CAMPAIGN_FINISHED       = 5;
    const CAMPAIGN_FAILED         = 6;

    const CAMPAIGN_RECORD_NEW     = 1;
    const CAMPAIGN_RECORD_PROCESS = 2;
    const CAMPAIGN_RECORD_FAILED  = 4;

    const SUBSCRIPTION_ACTIVE     = 1;
    const SUBSCRIPTION_INACTIVE   = 0;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    private $campaigns;

    /**
     * @var \ZfMetal\Mail\MailManager
     */
    private $mailManager;

    /**
     * BachProcessorController constructor.
     *
     * @param \Doctrine\ORM\EntityManager $em
     * @param \ZfMetal\Mail\MailManager $mailManager
     */
    public function __construct(\Doctrine\ORM\EntityManager $em, \ZfMetal\Mail\MailManager $mailManager)
    {
        $this->em = $em;
        $this->mailManager = $mailManager;
    }


    public function getEm()
    {
        return $this->em;
    }

    public function setEm(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function getEntityRepository()
    {
        return $this->getEm()->getRepository(self::ENTITY);
    }

    public function getCampaignRepository()
    {
        return $this->getEm()->getRepository(self::ENTITY);
    }

 

    public function activateCampaignAction(){
        $this->campaigns = $this->getCampaignWithState(self::CAMPAIGN_NEW);
        if (count($this->campaigns) == 0){
          return 'No campaigns to process' . PHP_EOL;
        }
        $this->setCampaignState(self::CAMPAIGN_TAKED);
        $this->createChampaignRecords();

        return count($this->campaigns) . ' campaigns activated'  . PHP_EOL;
    }

    public function processCampaignAction(){
      $this->campaigns = $this->getCampaignWithState(self::CAMPAIGN_ACTIVATED);
      if (count($this->campaigns) == 0){
        return 'No campaigns to process' . PHP_EOL;
      }
      $this->setCampaignState(self::CAMPAIGN_IN_PROCESS);
      $this->processCampaigns();

      return count($this->campaigns) . ' campaigns processed'  . PHP_EOL;
    }

    private function getCampaignWithState($state){
      return $this->getEntityRepository()->findBy([
        'state' => $this->getEm()->getReference(\ZfMetal\EmailCampaigns\Entity\CampaignState::class,$state)
      ], [
        'id' => 'ASC'
      ],
        $this->emailCampaignsOptions()->getSearchCampaignLimit()
      );
    }

    private function setCampaignState($state){
        for ($i=0; $i < count($this->campaigns); $i++) {
          $this->campaigns[$i]->setState($this->getEm()->getReference(\ZfMetal\EmailCampaigns\Entity\CampaignState::class, $state));
          $this->getEm()->persist($this->campaigns[$i]);
        }
        $this->getEm()->flush();
    }

    private function createChampaignRecords(){
      for ($i=0; $i < count($this->campaigns); $i++) {
        $campaign             = $this->campaigns[$i];
        $template             = $campaign->getTemplate();
        $distributionList     = $campaign->getDistributionList();
        $distributionRecords  = $this->getEm()->getRepository(\ZfMetal\EmailCampaigns\Entity\DistributionRecord::class)->findBy([
          'distributionList' => $this->getEm()->getReference(\ZfMetal\EmailCampaigns\Entity\DistributionList::class, $distributionList->getId()),
          'subscription'     => self::SUBSCRIPTION_ACTIVE
        ]);

        try{
          for ($j=0; $j < count($distributionRecords); $j++) {
            $distributionRecord = $distributionRecords[$j];
            $campaignRecord     = new \ZfMetal\EmailCampaigns\Entity\CampaignRecord();
            $campaignRecord
              ->setCampaign($campaign)
              ->setDistributionList($distributionList)
              ->setDistributionRecord($distributionRecord)
              ->setTemplate($template)
              ->setState($this->getEm()->getReference(\ZfMetal\EmailCampaigns\Entity\CampaignRecordState::class,self::CAMPAIGN_NEW));
            $this->getEm()->persist($campaignRecord);
            if($j % 100 == 0){
              $this->getEm()->flush();
            }
          }

          $campaign->setState($this->getEm()->getReference(\ZfMetal\EmailCampaigns\Entity\CampaignState::class,self::CAMPAIGN_ACTIVATED));
          $this->getEm()->persist($campaign);
          $this->getEm()->flush();
        } catch(\Exception $e){
          $this->logger()->err("Failed to process campaign con id " . $campaign->getId() . ". " . $e->getMessage());
          $campaign->setState($this->getEm()->getReference(\ZfMetal\EmailCampaigns\Entity\CampaignState::class,self::CAMPAIGN_FAILED));
          $this->getEm()->persist($campaign);
          $this->getEm()->flush();
        }
      }
    }

    private function processCampaigns(){
      for ($i=0; $i < count($this->campaigns); $i++) {
        $campaign             = $this->campaigns[$i];
        $template             = file_get_contents($campaign->getTemplate()->getFile_fp());
        $campaignRecords      = $this->getCampaignRecordsByIdWithState($campaign->getId(), self::CAMPAIGN_RECORD_NEW);
        $attachedFiles        = $this->getEm()->getRepository(\ZfMetal\EmailCampaigns\Entity\AttachedFiles::class)->findBy([
          'campaign' => $this->getEm()->getReference(\ZfMetal\EmailCampaigns\Entity\Campaign::class,$campaign->getId())
        ]);
        try{
          for ($j=0; $j < count($campaignRecords); $j++) {
              $campaignRecord   = $campaignRecords[$j];
              $result = $this->processCampaignsRecord($template, $campaignRecord, $attachedFiles);
              $state = $result ? self::CAMPAIGN_RECORD_PROCESS : self::CAMPAIGN_RECORD_FAILED;
              $campaignRecord->setSentDate(new \DateTime());
              $campaignRecord->setState($this->getEm()->getReference(\ZfMetal\EmailCampaigns\Entity\CampaignRecordState::class,$state));
              $this->getEm()->persist($campaign);
              if($j % 100 == 0){
                $this->getEm()->flush();
              }
          }
          $campaign->setFinishDate(new \DateTime());
          $campaign->setState($this->getEm()->getReference(\ZfMetal\EmailCampaigns\Entity\CampaignState::class,self::CAMPAIGN_FINISHED));
          $this->getEm()->persist($campaign);
          $this->getEm()->flush();
        } catch(\Exception $e){
          $this->logger()->err("Failed to process campaign con id " . $campaign->getId() . ". " . $e->getMessage());
          $campaign->setState($this->getEm()->getReference(\ZfMetal\EmailCampaigns\Entity\CampaignState::class,self::CAMPAIGN_FAILED));
          $this->getEm()->persist($campaign);
          $this->getEm()->flush();
        }
      }
    }

    private function getCampaignRecordsByIdWithState($campainId, $state){
      return $this->getEm()->getRepository(\ZfMetal\EmailCampaigns\Entity\CampaignRecord::class)->findBy([
        'state'    => $state,
        'campaign' => $this->getEm()->getReference(\ZfMetal\EmailCampaigns\Entity\Campaign::class,$campainId)
      ]);
    }

    /**
     * @param $template
     * @param $campaignRecord
     * @param $attachedFiles
     * @return bool
     */
    private function processCampaignsRecord($template, $campaignRecord, $attachedFiles){
        
        
      /**
       * $this->mailManager MailManager::class
       */  
      $this->mailManager->setBodyWithHtmlContent($template,'zf-metal/email-campaigns/template/unsubscribe',[
        'url' => $this->getUrlForUnsubscribe($campaignRecord->getDistributionList()->getId(), $campaignRecord->getDistributionRecord()->getId())
      ]);

      $this->mailManager->setFrom($campaignRecord->getDistributionList()->getOriginEmail());
      $this->mailManager->setTo($campaignRecord->getDistributionRecord()->getEmail(), $campaignRecord->getDistributionRecord()->getFirstName());
      $this->mailManager->setSubject($campaignRecord->getCampaign()->getSubject());

      for($i = 0; $i < count($attachedFiles); $i++){
        $a = $attachedFiles[$i];
        $this->mailManager->attachFile($attachedFiles[$i]->getName(), $attachedFiles[$i]->getFile());
      }

      if ($this->mailManager->send()) {
          $this->logger()->info("El registro " . $campaignRecord->getId() . " se proceso correctamente.");
          return true;
      } else {
          $this->logger()->err("Failed to process campaignRecord con id " . $campaignRecord->getId() . ".");
          return false;
      }
    }

    private function getUrlForUnsubscribe($lote, $subs){
      return $this->emailCampaignsOptions()->getUrlDomain() . 'email-campaigns/unsubscribe/' . $lote . '/' . $subs;
    }
}
