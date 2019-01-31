<?php

namespace ZfMetal\EmailCampaigns\Controller;

use Exception;
use Zend\Mvc\Controller\AbstractActionController;
use ZfMetal\Commons\Filter\RenameUpload;
use ZfMetal\EmailCampaigns\Options\ModuleOptions;

/**
 * Class CampaignController
 * @package ZfMetal\EmailCampaigns\Controller
 * @method ModuleOptions emailCampaignsOptions
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

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function setEm(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    public function getEntityRepository()
    {
        return $this->getEm()->getRepository(self::ENTITY);
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    public function getCampaignRepository()
    {
        return $this->getEm()->getRepository(self::ENTITY);
    }

    /**
     * CampaignController constructor.
     * @param \Doctrine\ORM\EntityManager $em
     * @param \ZfMetal\Datagrid\Grid $grid
     */
    public function __construct(\Doctrine\ORM\EntityManager $em, \ZfMetal\Datagrid\Grid $grid)
    {
        $this->em = $em;
        $this->grid = $grid;
    }

    /**
     * @return \ZfMetal\Datagrid\Grid
     */
    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * @param \ZfMetal\Datagrid\Grid $grid
     */
    public function setGrid(\ZfMetal\Datagrid\Grid $grid)
    {
        $this->grid = $grid;
    }

    /**
     * @return array
     */
    public function gridAction()
    {
        $this->grid->addExtraColumn('Detalle', ' <a class="registroBoton btn btn-primary" href="/email-campaigns/campaign-record/grid/{{id}}">VER</a> ', 'right');
        $this->grid->prepare();
        return array("grid" => $this->grid);
    }


    public function pauseAction()
    {
        $id = $this->params('id');
        $pause = $this->params('pause');
        $campaign = $this->getCampaign($id);

        $campaign->setPaused($pause);
        $this->getEm()->persist($campaign);
        $this->getEm()->flush();

        return ["campaign" => $campaign];
    }


    /**
     * @return array|\Zend\Http\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
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

    /**
     * @param null $id
     * @return null|object|\ZfMetal\EmailCampaigns\Entity\Campaign
     */
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

    /**
     * @param array $files
     * @param \ZfMetal\EmailCampaigns\Entity\Campaign $campaign
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws Exception
     */
    private function processFiles($files = array(), \ZfMetal\EmailCampaigns\Entity\Campaign $campaign){
      for($i = 0; $i < count($files); $i++){
        //"target":"public/audiosTemporales","use_upload_name":1,"overwrite":1
        if( !empty($files[$i]["name"]) ){

            $path = $this->emailCampaignsOptions()->getPathAttachedFiles();

            if (!file_exists($path)) {
                $result = mkdir($path, 0755, true);
                if (!$result) {
                    throw new Exception('Permission denied to create the folder: ' . $path);
                }
            }

            $filter = new RenameUpload([
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
