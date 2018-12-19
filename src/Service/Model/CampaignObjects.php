<?php
/**
 * Created by IntelliJ IDEA.
 * User: afurgeri
 * Date: 15/12/2018
 * Time: 12:37
 */

namespace ZfMetal\EmailCampaigns\Service\Model;


use ZfMetal\EmailCampaigns\Entity\Campaign;
use ZfMetal\EmailCampaigns\Entity\DistributionList;
use ZfMetal\EmailCampaigns\Entity\Template;

class CampaignObjects
{
    /**
     * @var Campaign
     */
    private $campaign;
    /**
     * @var Template
     */
    private $template;
    /**
     * @var DistributionList
     */
    private $distributionlist;
    /**
     * @var array
     */
    private $attachedFiles;

    /**
     * CampaignObjects constructor.
     * @param $campaign
     * @param $template
     * @param $distributionlist
     * @param $attachedFiles
     */
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
        $this->template = $campaign->getTemplate();
        $this->distributionlist = $campaign->getDistributionList();
        $this->attachedFiles = $campaign->getAttachedFiles();
    }

    /**
     * @return Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * @return Template
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return DistributionList
     */
    public function getDistributionlist()
    {
        return $this->distributionlist;
    }

    /**
     * @return array
     */
    public function getAttachedFiles()
    {
        return $this->attachedFiles;
    }

}