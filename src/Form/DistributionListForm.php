<?php

namespace ZfMetal\EmailCampaigns\Form;

/**
 * DistributionListFieldset
 */
class DistributionListForm extends \Zend\Form\Form
{
    public function __construct()
    {
        parent::__construct('DistributionList');
        $this->setAttribute('method', 'post');
        $this->setAttribute("enctype", "multipart/form-data");

        $this->add([
            'name' => 'id',
            'type' => \Zend\Form\Element\Hidden::class,
            'attributes' => [
                'type' => 'hidden',
            ],
        ]);

        $this->add([
            'name' => 'nameList',
            'type' => \Zend\Form\Element\Text::class,
            'options' => [
                'label' => 'Nombre de Lista',
                'description' => '',
                'addon' => '',
            ],
            'attributes' => [
                'type' => 'text',
            ],
        ]);

        $this->add([
            'name' => 'originEmail',
            'type' => \Zend\Form\Element\Text::class,
            'options' => [
                'label' => 'Email Originador',
                'description' => '',
                'addon' => '',
            ],
            'attributes' => [
                'type' => 'text',
            ],
        ]);

        $this->add([
            'name' => 'originName',
            'type' => \Zend\Form\Element\Text::class,
            'options' => [
                'label' => 'Nombre Originador',
                'description' => '',
                'addon' => '',
            ],
            'attributes' => [
                'type' => 'text',
            ],
        ]);

        $this->add(array(
            'name' => 'fileUpload',
            'type' => \Zend\Form\Element\File::class,
            'attributes' => array(
                'class' => 'btn btn-default btn-block',
                'accept' => "text/csv",
                'id' => 'fileUpload',
                'name' => 'fileUpload'
            ),
            'options' => array(
                'label' => 'Lote',
            )
        ));

        $this->add(array(
           'name' => 'submit',
           'type' => 'Zend\Form\Element\Submit',
           'attributes' => array(
               'value' => "ENVIAR",
               'class' => 'pull-right btn btn-primary',
               'style' => 'margin-left: 2px',
            )
       ));

       $this->add(array(
            'name' => 'cancelar',
            'type' => 'Zend\Form\Element\Button',
            'attributes' => array(
                'value' => "Cancelar",
                'class' => 'pull-right btn btn-default',
                'style' => 'margin-left: 2px',
                'onclick'=>'window.location.href="/email-campaigns/distribution-list/grid"'
            )
       ));


    }
}
