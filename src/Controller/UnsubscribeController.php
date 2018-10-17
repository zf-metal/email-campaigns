<?php

namespace ZfMetal\EmailCampaigns\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UnsubscribeController extends AbstractActionController
{

    const ENTITY                = 'ZfMetal\EmailCampaigns\\Entity\\DistributionRecord';

    const SUBSCRIPTION_ACTIVE   = 1;

    const SUBSCRIPTION_INACTIVE = 0;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    public $em = null;

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

    public function getDistributionRecordRepository()
    {
        return $this->getEm()->getRepository(self::ENTITY);
    }

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function unsubscribeAction()
    {
        $list       = $this->params('list');
        $subscribed = $this->params('subscribed');

        $distributionRecord = $this->getEntityRepository()
          ->findOneBy([
            'id' => $subscribed,
            'distributionList' => $this->getEm()
                  ->getReference(\ZfMetal\EmailCampaigns\Entity\DistributionList::class, $list)
          ]);

        if($distributionRecord && $distributionRecord->getSubscription() == self::SUBSCRIPTION_ACTIVE){
            $distributionRecord->setSubscription(self::SUBSCRIPTION_INACTIVE);
            $this->getEm()->persist($distributionRecord);
            $this->getEm()->flush();
        }

        //return [];

        $this->redirect()->toRoute('ZfMetal_EmailCampaigns/Unsubscribe/Confirmation');
    }

    public function confirmationAction()
    {

      $view = new ViewModel();
      $view->setTerminal(true);

      // This is the way to change render(view)..
      $view->setTemplate('zf-metal/email-campaigns/unsubscribe/confirmation');

      return $view;
    }


}
