<?php

namespace ZfMetal\EmailCampaigns\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * DistributionListController
 */
class DistributionListController extends AbstractActionController
{
    const ENTITY              = \ZfMetal\EmailCampaigns\Entity\DistributionList::class;
    const SUBSCRIPTION_ACTIVE = 1;
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    public $em = null;

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

    public function getDistributionListRepository()
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
        $this->grid->addExtraColumn('', ' <a class="registroBoton btn btn-primary" href="/email-campaigns/distribution-record/grid/{{id}}"><i class="material-icons">assignment</i></a> ', 'right');

        $this->grid->prepare();
        return array("grid" => $this->grid);
    }

    public function newEditAction()
    {
        $id = $this->params('id');
        $form = new \ZfMetal\EmailCampaigns\Form\DistributionListForm;
        $form->setInputFilter(new \ZfMetal\EmailCampaigns\Form\Filter\DistributionListFilter($this->getEm(), $id));
        $distributionList = $this->getDistributionList($id);
        $form->setHydrator(new \DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity($this->getEm()));
        $form->bind($distributionList);

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $form->setData($data);
            if ($form->isValid()) {
                $this->getEm()->persist($distributionList);
                $this->getEm()->flush();

                $file = $this->getRequest()->getFiles();
                if($this->getFilePath($file)){
                    //$this->removeActualRecordsList($distributionList);
                    $this->processFile($file, $distributionList);
                }

                $this->flashMessenger()->addSuccessMessage('Lista creada con éxito.');

                return $this->redirect()->toUrl('/email-campaigns/distribution-list/grid');
            } else {
                $this->flashMessenger()->addErrorMessage('Hubo un inconveniente, revise el formulario. ');
            }
        }

        return ['form' => $form];
    }

    private function getDistributionList($id = null){
      $distributionList = null;
      if($id){
          $distributionList = $this->getEntityRepository()->find($id);
      }
      if(!$distributionList){
          $distributionList = new \ZfMetal\EmailCampaigns\Entity\DistributionList;
      }
      return $distributionList;
    }

    private function removeActualRecordsList($distributionList){
        foreach ($distributionList->getRecords() as $record) {
            $this->getEm()->remove($record);
        }
        $this->getEm()->flush();
    }

    private function getFilePath($file){
      return $file['fileUpload']['tmp_name'];
    }

    private function processFile($file, $distributionList)
    {

        $c = 0;
        $filePath = $this->getFilePath($file);
        $delimiter = ';';
        $hidrator = new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($this->getEm());

        $this->getEm()->getConnection()->beginTransaction();
        try {
            if (($fileList = fopen($filePath, "r")) !== FALSE){
                $columnsName = fgetcsv($fileList, 0, $delimiter, "\"", "\"");
                while (($data = fgetcsv($fileList, 0, $delimiter, "\"", "\"")) !== FALSE) {
                    $reg = array();
                    for ($i = 0; $i < count($data); $i++) {
                        $reg[$columnsName[$i]] = $data[$i];
                    }

                    $obj = new \ZfMetal\EmailCampaigns\Entity\DistributionRecord();
                    $obj = $hidrator->hydrate($reg, $obj);
                    $obj->setDistributionList($distributionList);
                    $obj->setSubscription(self::SUBSCRIPTION_ACTIVE);
                    $this->getEm()->persist($obj);

                    $c++;
                    if ($c % 1000 == 0) {
                        $this->getEm()->flush();
                        $this->getEm()->clear();
                    }
                }

                $this->getEm()->flush();
                $this->getEm()->clear();
            }

            $this->getEm()->getConnection()->commit();

            return $c;

        } catch (\Exception $e) {
            $this->getEm()->getConnection()->rollBack();
            throw $e;
        }
    }
}
