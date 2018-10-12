<?php

namespace ZfMetal\EmailCampaigns\Form;

/**
 * DistributionListFieldset
 */
class CampaignForm extends \Zend\Form\Form
{
    public function __construct($em)
    {
        parent::__construct('Campaign');
        $this->setAttribute('method', 'post');
        $this->setAttribute("enctype", "multipart/form-data");
        $this->setAttribute('class', 'dropzone');
        $this->setAttribute('id', 'my-awesome-dropzone');


        $this->add([
            'name' => 'id',
            'type' => \Zend\Form\Element\Hidden::class,
            'attributes' => [
                'type' => 'hidden',
            ],
        ]);

        $this->add([
            'name' => 'subject',
            'type' => \Zend\Form\Element\Text::class,
            'options' => [
                'label' => 'Subject',
                'description' => '',
                'addon' => '',
            ],
            'attributes' => [
                'type' => 'text',
            ],
        ]);

        $this->add([
            'name' => 'distributionList',
            'type' => \DoctrineModule\Form\Element\ObjectSelect::class,
            'options' => [
                'object_manager' => $em,
                'label' => 'Distribution List',
                'description' => '',
                'addon' => '',
                'empty_option' => '',
                'target_class' => \ZfMetal\EmailCampaigns\Entity\DistributionList::class,
            ],
        ]);

        $this->add([
            'name' => 'template',
            'type' => \DoctrineModule\Form\Element\ObjectSelect::class,
            'options' => [
                'object_manager' => $em,
                'label' => 'Template',
                'description' => '',
                'addon' => '',
                'empty_option' => '',
                'target_class' => \ZfMetal\EmailCampaigns\Entity\Template::class,
            ],
        ]);

        $this->add(array(
            'name' => 'attached_files[]',
            'type' => \Zend\Form\Element\File::class,
            'attributes' => array(
                'class' => 'btn btn-default btn-block',
                'id' => 'attachedFiles',
                'name' => 'attached_files[]'
            ),
            'options' => array(
                'label' => 'Attached Files',
                'multiple' => 'multiple'
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
                'onclick'=>'window.location.href="/email-campaigns/campaign/grid"'
            )
       ));
    }
}
