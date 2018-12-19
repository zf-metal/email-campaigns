<?php

namespace ZfMetal\EmailCampaigns\Entity;

use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;
use Zend\Form\Annotation as Annotation;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * DistributionList
 * @ORM\Table(name="zfec_distribution_lists")
 * @ORM\Entity(repositoryClass="ZfMetal\EmailCampaigns\Repository\DistributionListRepository")
 */
class DistributionList
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
     * @Annotation\Options({"label":"Nombre de Lista", "description":"", "addon":""})
     * @ORM\Column(type="string", length=50, unique=true, nullable=false,
     * name="name_list")
     */
    public $nameList = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Email Originador", "description":"", "addon":""})
     * @ORM\Column(type="string", length=100, unique=false, nullable=false,
     * name="origin_email")
     */
    public $originEmail = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Nombre Originador", "description":"", "addon":""})
     * @ORM\Column(type="string", length=50, unique=false, nullable=true,
     * name="origin_name")
     */
    public $originName = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @Annotation\Attributes({"type":"hidden"})
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @ORM\OneToMany(targetEntity="\ZfMetal\EmailCampaigns\Entity\DistributionRecord",
     * mappedBy="distributionList", cascade={"persist", "remove"})
     */
    public $records = null;

    /**
     * DistributionList constructor.
     */
    public function __construct()
    {
        $this->records = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNameList()
    {
        return $this->nameList;
    }

    public function setNameList($nameList)
    {
        $this->nameList = $nameList;
        return $this;
    }

    public function getOriginEmail()
    {
        return $this->originEmail;
    }

    public function setOriginEmail($originEmail)
    {
        $this->originEmail = $originEmail;
        return $this;
    }

    public function getOriginName()
    {
        return $this->originName;
    }

    public function setOriginName($originName)
    {
        $this->originName = $originName;
        return $this;
    }

    public function getRecords()
    {
        return $this->records;
    }

    public function setRecords($records)
    {
        $this->records = $records;
        return $this;
    }

    public function __toString()
    {
        return (string) $this->nameList;
    }

}
