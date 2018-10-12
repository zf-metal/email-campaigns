<?php

namespace ZfMetal\EmailCampaigns\Entity;

use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;
use Zend\Form\Annotation as Annotation;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Campaign
 * @ORM\Table(name="zfec_campaigns")
 * @ORM\Entity(repositoryClass="ZfMetal\EmailCampaigns\Repository\CampaignRepository")
 */
class Campaign
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
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Options({"label":"Lista de distribución","empty_option": "",
     * "target_class":"\ZfMetal\EmailCampaigns\Entity\DistributionList", "description":""})
     * @ORM\ManyToOne(targetEntity="\ZfMetal\EmailCampaigns\Entity\DistributionList")
     * @ORM\JoinColumn(name="distribution_list_id", referencedColumnName="id",
     * nullable=false)
     */
    public $distributionList = null;

    /**
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Options({"label":"Template","empty_option": "",
     * "target_class":"\ZfMetal\EmailCampaigns\Entity\Template", "description":""})
     * @ORM\ManyToOne(targetEntity="\ZfMetal\EmailCampaigns\Entity\Template")
     * @ORM\JoinColumn(name="template_id", referencedColumnName="id", nullable=false)
     */
    public $template = null;

    /**
     * @Annotation\Exclude()
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", unique=false, nullable=false, name="create_date")
     */
    public $createDate = null;

    /**
     * @Annotation\Exclude()
     * @ORM\Column(type="datetime", unique=false, nullable=true, name="finish_date")
     */
    public $finishDate = null;

    /**
     * @Annotation\Exclude()
     * @ORM\ManyToOne(targetEntity="\ZfMetal\EmailCampaigns\Entity\CampaignState")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id", nullable=false)
     */
    public $state = null;

    /**
     * @Annotation\Exclude()
     * @ORM\OneToMany(targetEntity="\ZfMetal\EmailCampaigns\Entity\AttachedFiles",
     * mappedBy="campaign")
     */
    public $attachedFiles = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Subject", "description":"", "addon":""})
     * @ORM\Column(type="string", length=50, unique=false, nullable=true,
     * name="subject")
     */
    public $subject = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDistributionList()
    {
        return $this->distributionList;
    }

    public function setDistributionList($distributionList)
    {
        $this->distributionList = $distributionList;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }

    public function getFinishDate()
    {
        return $this->finishDate;
    }

    public function setFinishDate($finishDate)
    {
        $this->finishDate = $finishDate;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getAttachedFiles()
    {
        return $this->attachedFiles;
    }

    public function setAttachedFiles($attachedFiles)
    {
        $this->attachedFiles = $attachedFiles;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function __toString()
    {
        return (string) $this->id;
    }


}
