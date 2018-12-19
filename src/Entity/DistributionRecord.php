<?php

namespace ZfMetal\EmailCampaigns\Entity;

use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;
use Zend\Form\Annotation as Annotation;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * DistributionRecord
 * @ORM\Table(name="zfec_distribution_records")
 * @ORM\Entity(repositoryClass="ZfMetal\EmailCampaigns\Repository\DistributionRecordRepository")
 */
class DistributionRecord
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
     * @Annotation\Options({"label":"Lista","empty_option": "",
     * "target_class":"\ZfMetal\EmailCampaigns\Entity\DistributionList", "description":""})
     * @ORM\ManyToOne(targetEntity="\ZfMetal\EmailCampaigns\Entity\DistributionList")
     * @ORM\JoinColumn(name="distribution_list_id", referencedColumnName="id",
     * nullable=false)
     */
    public $distributionList = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Nombre", "description":"", "addon":""})
     * @ORM\Column(type="string", length=50, unique=false, nullable=true,
     * name="first_name")
     */
    public $firstName = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Apellido", "description":"", "addon":""})
     * @ORM\Column(type="string", length=50, unique=false, nullable=true,
     * name="last_name")
     */
    public $lastName = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Email", "description":"", "addon":""})
     * @ORM\Column(type="string", length=100, unique=false, nullable=true,
     * name="email")
     */
    public $email = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Telefono", "description":"", "addon":""})
     * @ORM\Column(type="string", length=14, unique=false, nullable=true, name="phone")
     */
    public $phone = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Clave1", "description":"", "addon":""})
     * @ORM\Column(type="string", length=100, unique=false, nullable=true,
     * name="customer_field1")
     */
    public $customerField1 = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Clave2", "description":"", "addon":""})
     * @ORM\Column(type="string", length=100, unique=false, nullable=true,
     * name="customer_field2")
     */
    public $customerField2 = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Clave3", "description":"", "addon":""})
     * @ORM\Column(type="string", length=100, unique=false, nullable=true,
     * name="customer_field3")
     */
    public $customerField3 = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Attributes({"type":"checkbox"})
     * @Annotation\Options({"label":"Suscripción Activa", "description":"", "addon":""})
     * @ORM\Column(type="integer", length=1, unique=false, nullable=true,
     * name="subscription")
     */
    public $subscription = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getDistributionList()
    {
        return $this->distributionList;
    }

    public function setDistributionList($distributionList)
    {
        $this->distributionList = $distributionList;
        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function getCustomerField1()
    {
        return $this->customerField1;
    }

    public function setCustomerField1($customerField1)
    {
        $this->customerField1 = $customerField1;
        return $this;
    }

    public function getCustomerField2()
    {
        return $this->customerField2;
    }

    public function setCustomerField2($customerField2)
    {
        $this->customerField2 = $customerField2;
        return $this;
    }

    public function getCustomerField3()
    {
        return $this->customerField3;
    }

    public function setCustomerField3($customerField3)
    {
        $this->customerField3 = $customerField3;
        return $this;
    }

    public function getSubscription()
    {
        return $this->subscription;
    }

    public function setSubscription($subscription)
    {
        $this->subscription = $subscription;
        return $this;
    }

    public function __toString()
    {
        return (string) $this->email;
    }

    public function __get($property) {
      if (property_exists($this, $property)) {
        return $this->$property;
      }
      return '';
    }

}
