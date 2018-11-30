<?php

namespace ZfMetal\EmailCampaigns\Options;

class ModuleOptions extends \Zend\Stdlib\AbstractOptions
{

    private $urlDomain = '';

    private $searchCampaignLimit = '5';

    private $pathAttachedFiles = './files';

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


}

