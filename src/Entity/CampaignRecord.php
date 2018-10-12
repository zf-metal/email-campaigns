<?php

namespace ZfMetal\EmailCampaigns\Entity;

use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;
use Zend\Form\Annotation as Annotation;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CampaignRecord
 * @ORM\Table(name="zfec_campaign_records")
 * @ORM\Entity(repositoryClass="ZfMetal\EmailCampaigns\Repository\CampaignRecordRepository")
 */
class CampaignRecord
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
     * @Annotation\Options({"label":"Campaign","empty_option": "",
     * "target_class":"\ZfMetal\EmailCampaigns\Entity\Campaign", "description":""})
     * @ORM\ManyToOne(targetEntity="\ZfMetal\EmailCampaigns\Entity\Campaign")
     * @ORM\JoinColumn(name="campaign_id", referencedColumnName="id", nullable=false)
     */
    public $campaign = null;

    /**
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Options({"label":"Distribution List","empty_option": "",
     * "target_class":"\ZfMetal\EmailCampaigns\Entity\DistributionList", "description":""})
     * @ORM\ManyToOne(targetEntity="\ZfMetal\EmailCampaigns\Entity\DistributionList")
     * @ORM\JoinColumn(name="distribution_list_id", referencedColumnName="id",
     * nullable=false)
     */
    public $distributionList = null;

    /**
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Options({"label":"Distribution Record","empty_option": "",
     * "target_class":"\ZfMetal\EmailCampaigns\Entity\DistributionRecord", "description":""})
     * @ORM\ManyToOne(targetEntity="\ZfMetal\EmailCampaigns\Entity\DistributionRecord")
     * @ORM\JoinColumn(name="distribution_record_id", referencedColumnName="id",
     * nullable=false)
     */
    public $distributionRecord = null;

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
     * @ORM\Column(type="datetime", unique=false, nullable=false, name="created_date")
     */
    public $createdDate = null;

    /**
     * @Annotation\Type("Zend\Form\Element\DateTime")
     * @Annotation\Attributes({"type":"datetime"})
     * @Annotation\Options({"label":"Sent Date", "description":"", "addon":""})
     * @ORM\Column(type="datetime", unique=false, nullable=true, name="sent_date")
     */
    public $sentDate = null;

    /**
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Options({"label":"State","empty_option": "",
     * "target_class":"\ZfMetal\EmailCampaigns\Entity\CampaignRecordState", "description":""})
     * @ORM\ManyToOne(targetEntity="\ZfMetal\EmailCampaigns\Entity\CampaignRecordState")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id", nullable=false)
     */
    public $state = null;

    public function __toString()
    {
        return (string) $this->id." ".  $this->campaign;
    }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Campaign
     *
     * @return mixed
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * Set the value of Campaign
     *
     * @param mixed campaign
     *
     * @return self
     */
    public function setCampaign($campaign)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * Get the value of Distribution List
     *
     * @return mixed
     */
    public function getDistributionList()
    {
        return $this->distributionList;
    }

    /**
     * Set the value of Distribution List
     *
     * @param mixed distributionList
     *
     * @return self
     */
    public function setDistributionList($distributionList)
    {
        $this->distributionList = $distributionList;

        return $this;
    }

    /**
     * Get the value of Distribution Record
     *
     * @return mixed
     */
    public function getDistributionRecord()
    {
        return $this->distributionRecord;
    }

    /**
     * Set the value of Distribution Record
     *
     * @param mixed distributionRecord
     *
     * @return self
     */
    public function setDistributionRecord($distributionRecord)
    {
        $this->distributionRecord = $distributionRecord;

        return $this;
    }

    /**
     * Get the value of Template
     *
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set the value of Template
     *
     * @param mixed template
     *
     * @return self
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get the value of Created Date
     *
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set the value of Created Date
     *
     * @param mixed createdDate
     *
     * @return self
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get the value of Sent Date
     *
     * @return mixed
     */
    public function getSentDate()
    {
        return $this->sentDate;
    }

    /**
     * Set the value of Sent Date
     *
     * @param mixed sentDate
     *
     * @return self
     */
    public function setSentDate($sentDate)
    {
        $this->sentDate = $sentDate;

        return $this;
    }

    /**
     * Get the value of State
     *
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of State
     *
     * @param mixed state
     *
     * @return self
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

}
