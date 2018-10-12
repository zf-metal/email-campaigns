<?php

namespace ZfMetal\EmailCampaigns\Entity;

use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;
use Zend\Form\Annotation as Annotation;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AttachedFiles
 * @ORM\Table(name="zfec_attached_files")
 * @ORM\Entity(repositoryClass="ZfMetal\EmailCampaigns\Repository\AttachedFilesRepository")
 */
class AttachedFiles
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
     * @Annotation\Options({"label":"campaign","empty_option": "",
     * "target_class":"\ZfMetal\EmailCampaigns\Entity\Campaign", "description":""})
     * @ORM\ManyToOne(targetEntity="\ZfMetal\EmailCampaigns\Entity\Campaign")
     * @ORM\JoinColumn(name="campaign_id", referencedColumnName="id", nullable=false)
     */
    public $campaign = null;

    /**
     * @Annotation\Type("Zend\Form\Element\File")
     * @Annotation\Attributes({"type":"file"})
     * @Annotation\Options({"label":"file","absolutepath":"","webpath":"",
     * "description":""})
     * @Annotation\Filter({"name":"filerenameupload",
     * "options":{"target":"","use_upload_name":1,"overwrite":1}})
     * @ORM\Column(type="string", length=0, unique=false, nullable=false, name="file")
     */
    public $file = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCampania()
    {
        return $this->campania;
    }

    public function setCampania($campania)
    {
        $this->campania = $campania;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getName()
    {
        return basename($this->getFile());
    }

    public function getCampaign()
    {
        return $this->campaign;
    }

    public function setCampaign($campaign)
    {
        $this->campaign = $campaign;
    }

    public function getFile_ap()
    {
        return "";
    }

    public function getFile_wp()
    {
        return "";
    }

    public function getFile_fp()
    {
        return "".$this->file;
    }

    public function __toString()
    {
        return (string) $this->file;
    }

}
