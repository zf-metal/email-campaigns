<?php

namespace ZfMetal\EmailCampaigns\Options;

class ModuleOptions extends \Zend\Stdlib\AbstractOptions
{

    private $urlDomain = '';

    private $searchCampaignLimit = '5';

    private $pathAttachedFiles = './files';

    private $delayBetweenEmails = 100;

    private $limitRecordsPerCicle = 10;

    private $distributionRecordFields = [
      '@nombre'   => 'firstName',
      '@apellido' => 'lastName',
      '@email'    => 'email',
      '@telefono' => 'phone',
      '@c1'       => 'customerField1',
      '@c2'       => 'customerField2',
      '@c3'       => 'customerField3',
    ];

    public function getUrlDomain()
    {
        return $this->urlDomain;
    }

    public function setUrlDomain($urlDomain)
    {
        $this->urlDomain= $urlDomain;
    }

    public function getSearchCampaignLimit()
    {
        return $this->searchCampaignLimit;
    }

    public function setSearchCampaignLimit($searchCampaignLimit)
    {
        $this->searchCampaignLimit= $searchCampaignLimit;
    }

    public function getPathAttachedFiles()
    {
        return $this->pathAttachedFiles;
    }

    public function setPathAttachedFiles($pathAttachedFiles)
    {
        $this->pathAttachedFiles= $pathAttachedFiles;
    }

    public function getDistributionRecordFields()
    {
        return $this->distributionRecordFields;
    }

    public function setDistributionRecordFields($distributionRecordFields)
    {
        $this->distributionRecordFields= $distributionRecordFields;
    }

    /**
     * @return int
     */
    public function getDelayBetweenEmails()
    {
        return $this->delayBetweenEmails;
    }

    /**
     * @param int $delayBetweenEmails
     */
    public function setDelayBetweenEmails($delayBetweenEmails)
    {
        $this->delayBetweenEmails = $delayBetweenEmails;
    }

    /**
     * @return int
     */
    public function getLimitRecordsPerCicle()
    {
        return $this->limitRecordsPerCicle;
    }

    /**
     * @param int $limitRecordsPerCicle
     */
    public function setLimitRecordsPerCicle($limitRecordsPerCicle)
    {
        $this->limitRecordsPerCicle = $limitRecordsPerCicle;
    }
    
    


}
