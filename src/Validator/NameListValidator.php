<?php

namespace ZfMetal\EmailCampaigns\Validator;

use Zend\Validator\AbstractValidator;

class NameListValidator extends AbstractValidator
{
    const ENTITY                = \ZfMetal\EmailCampaigns\Entity\DistributionList::class;
    const FIND_BY               = 'nameList';
    const ERROR_DUPLICATED_NAME = 'errorDuplicatedName';

    /**
     * @var array Message templates
     */
    protected $messageTemplates = [
        self::ERROR_DUPLICATED_NAME => "The name of the list is duplicated",
    ];

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em = null;

    protected $exclude;

    public function __construct($options = [])
    {
        parent::__construct($options);
        if (array_key_exists('em', $options)) {
            $this->setEm($options['em']);
        }

        if (array_key_exists('exclude', $options)) {
            $this->setExclude($options['exclude']);
        }
    }

    public function getEm()
    {
        return $this->em;
    }

    public function setEm(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
        return $this;
    }

    public function getExclude()
    {
        return $this->exclude;
    }

    public function setExclude($exclude)
    {
        $this->exclude = $exclude;
        return $this;
    }

    public function isValid($value, $context = null)
    {
        $valid = true;
        $this->setValue($value);

        $distributionList = $this->getEm()->getRepository(self::ENTITY)->findOneBy([
            self::FIND_BY => $value
        ]);

        if($distributionList){
            if($distributionList->getId() != $this->getExclude()){
                $this->error(self::ERROR_DUPLICATED_NAME);
                $valid = false;
            }
        }

        return $valid;
    }
}
