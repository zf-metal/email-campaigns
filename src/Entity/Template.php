<?php

namespace ZfMetal\EmailCampaigns\Entity;

use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;
use Zend\Form\Annotation as Annotation;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Template
 * @ORM\Table(name="zfec_templates")
 * @ORM\Entity(repositoryClass="ZfMetal\EmailCampaigns\Repository\TemplateRepository")
 */
class Template
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
     * @Annotation\Options({"label":"Nombre", "description":"", "addon":""})
     * @ORM\Column(type="string", length=50, unique=true, nullable=false, name="name")
     */
    public $name = null;

    /**
     * @Annotation\Type("Zend\Form\Element\File")
     * @Annotation\Attributes({"type":"file"})
     * @Annotation\Options({"label":"file","absolutepath":"/var/www/html/TestProject/public/uploads/","webpath":"uploads/", "description":""})
     * @Annotation\Filter({"name":"\ZfMetal\Commons\Filter\RenameUpload",
     * "options":{"target":"public/uploads","use_upload_name":1,"overwrite":1}})
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getFile_ap()
    {
        return "";
    }

    public function getFile_wp()
    {
        return "Archivo de Template";
    }

    public function getFile_fp()
    {
        return "./public/uploads/" .$this->file;
    }

    public function __toString()
    {
        return (string) $this->name;
    }


}
