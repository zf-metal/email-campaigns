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
     * @Annotation\Options({"label":"distributionList","empty_option": "",
     * "target_class":"\ZfMetal\EmailCampaigns\Entity\DistributionList", "description":""})
     * @ORM\ManyToOne(targetEntity="\ZfMetal\EmailCampaigns\Entity\DistributionList")
     * @ORM\JoinColumn(name="distribution_list_id", referencedColumnName="id",
     * nullable=false)
     */
    public $distributionList = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"firstName", "description":"", "addon":""})
     * @ORM\Column(type="string", length=50, unique=false, nullable=true,
     * name="first_name")
     */
    public $firstName = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"lastName", "description":"", "addon":""})
     * @ORM\Column(type="string", length=50, unique=false, nullable=true,
     * name="last_name")
     */
    public $lastName = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"email", "description":"", "addon":""})
     * @ORM\Column(type="string", length=100, unique=false, nullable=true,
     * name="email")
     */
    public $email = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"phone", "description":"", "addon":""})
     * @ORM\Column(type="string", length=14, unique=false, nullable=true, name="phone")
     */
    public $phone = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"customerField1", "description":"", "addon":""})
     * @ORM\Column(type="string", length=100, unique=false, nullable=true,
     * name="customer_field1")
     */
    public $customerField1 = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"customerField2", "description":"", "addon":""})
     * @ORM\Column(type="string", length=100, unique=false, nullable=true,
     * name="customer_field2")
     */
    public $customerField2 = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"customerField3", "description":"", "addon":""})
     * @ORM\Column(type="string", length=100, unique=false, nullable=true,
     * name="customer_field3")
     */
    public $customerField3 = null;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"subscription", "description":"", "addon":""})
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
    }

    public function getDistributionList()
    {
        return $this->distributionList;
    }

    public function setDistributionList($distributionList)
    {
        $this->distributionList = $distributionList;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getCustomerField1()
    {
        return $this->customerField1;
    }

    public function setCustomerField1($customerField1)
    {
        $this->customerField1 = $customerField1;
    }

    public function getCustomerField2()
    {
        return $this->customerField2;
    }

    public function setCustomerField2($customerField2)
    {
        $this->customerField2 = $customerField2;
    }

    public function getCustomerField3()
    {
        return $this->customerField3;
    }

    public function setCustomerField3($customerField3)
    {
        $this->customerField3 = $customerField3;
    }

    public function getSubscription()
    {
        return $this->subscription;
    }

    public function setSubscription($subscription)
    {
        $this->subscription = $subscription;
    }

    public function __toString()
    {
        return (string) $this->email;
    }


}
