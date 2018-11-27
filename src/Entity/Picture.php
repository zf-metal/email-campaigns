<?php

namespace ZfMetal\EmailCampaigns\Entity;

use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;
use Zend\Form\Annotation as Annotation;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Picture
 *
 *
 *
 * @author
 * @license
 * @link
 * @ORM\Table(name="zfec_pictures_repository")
 * @ORM\Entity(repositoryClass="EmailCampaigns\Repository\PictureRepository")
 */
class Picture
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
     * @Annotation\Type("Zend\Form\Element\File")
     * @Annotation\Attributes({"type":"file"})
     * @Annotation\Options({"label":"file","absolutepath":"./public/pictures/","webpath":"/pictures/",
     * "description":""})
     * @Annotation\Filter({"name":"\ZfMetal\Commons\Filter\RenameUpload",
     * "options":{"target":"public/pictures","use_upload_name":1,"overwrite":1}})
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
        return "./public/pictures/";
    }

    public function getFile_wp()
    {
        return "/pictures/";
    }

    public function getFile_fp()
    {
        return "./public/pictures/".$this->file;
    }

    public function __toString()
    {
        return (string) $this->getFile();
    }


}
