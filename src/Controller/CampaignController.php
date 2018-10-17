<?php

namespace ZfMetal\EmailCampaigns\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * CampaignController
 */
class CampaignController extends AbstractActionController
{

    const ENTITY = 'ZfMetal\EmailCampaigns\\Entity\\Campaign';

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    public $em   = null;

    /**
     * @var \ZfMetal\Datagrid\Grid
     */
    public $grid = null;

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

    public function __construct(\Doctrine\ORM\EntityManager $em, \ZfMetal\Datagrid\Grid $grid)
    {
        $this->em = $em;
        $this->grid = $grid;
    }

    public function getGrid()
    {
        return $this->grid;
    }

    public function setGrid(\ZfMetal\Datagrid\Grid $grid)
    {
        $this->grid = $grid;
    }

    public function gridAction()
    {
        $this->grid->addExtraColumn('', ' <a class="registroBoton btn btn-primary" href="/email-campaigns/campaign-record/grid/{{id}}"><i class="material-icons">assignment</i></a> ', 'right');
        $this->grid->prepare();
        return array("grid" => $this->grid);
    }

    public function newEditAction()
    {
      $id = $this->params('id');
      $form = new \ZfMetal\EmailCampaigns\Form\CampaignForm($this->getEm());
      $campaign = $this->getCampaign($id);
      $form->setHydrator(new \DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity($this->getEm()));
      $form->bind($campaign);

      if ($this->getRequest()->isPost()) {
          $data = $this->getRequest()->getPost();
          $form->setData($data);
          if ($form->isValid()) {
              $campaign->setState($this->getEm()->getReference(\ZfMetal\EmailCampaigns\Entity\CampaignState::class, 1));
              $this->getEm()->persist($campaign);
              $this->getEm()->flush();

              $files = $this->getRequest()->getFiles();
              $this->processFiles($files['attached_files'], $campaign);

              $this->flashMessenger()->addSuccessMessage('Campaña creada con éxito.');
              return $this->redirect()->toUrl('/email-campaigns/campaign/grid');
          } else {
              $this->flashMessenger()->addErrorMessage('Hubo un inconveniente, revise el formulario. ');
          }
      }

      return ['form' => $form];
    }

    private function getCampaign($id = null){
      $campaign = null;
      if($id){
          $campaign = $this->getEntityRepository()->find($id);
      }
      if(!$campaign){
          $campaign = new \ZfMetal\EmailCampaigns\Entity\Campaign;
      }
      return $campaign;
    }

    private function processFiles($files = array(), \ZfMetal\EmailCampaigns\Entity\Campaign $campaign){
      for($i = 0; $i < count($files); $i++){
        //"target":"public/audiosTemporales","use_upload_name":1,"overwrite":1
        if( !empty($files[$i]["name"]) ){
            $path = $this->emailCampaignsOptions()->getPathAttachedFiles();
            $filter = new \ZfMetal\Security\Filter\RenameUpload([
              'target' => $path,
              'use_upload_name' => true,
              'overwrite' => true
            ]);
            $name = $filter->filter($files[$i]);
            $attachedFile = new \ZfMetal\EmailCampaigns\Entity\attachedFiles;
            $attachedFile->setCampaign($campaign);
            $attachedFile->setFile($path . '/' . $name);

            $this->getEm()->persist($attachedFile);
            $this->getEm()->flush();
        }
      }
    }

}
