<?php

namespace ZfMetal\EmailCampaigns\Entity;

use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;
use Zend\Form\Annotation as Annotation;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CampaignRecordState
 * @ORM\Table(name="zfec_campaign_record_states")
 * @ORM\Entity(repositoryClass="ZfMetal\EmailCampaigns\Repository\CampaignRecordStateRepository")
 */
class CampaignRecordState
{

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"ID", "description":"", "addon":""})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", length=11, unique=false, nullable=false, name="id")
     */
    public $id = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Name", "description":"", "addon":""})
     * @ORM\Column(type="string", length=25, unique=true, nullable=false, name="name")
     */
    public $name = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Web Name", "description":"", "addon":""})
     * @ORM\Column(type="string", length=25, unique=false, nullable=true,
     * name="web_name")
     */
    public $webName = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getWebName()
    {
        return $this->webName;
    }

    public function setWebName($webName)
    {
        $this->webName = $webName;
    }

    public function __toString()
    {
        return (string) $this->name;
    }


}
