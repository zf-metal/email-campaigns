<?php
/**
 * Created by IntelliJ IDEA.
 * User: afurgeri
 * Date: 15/12/2018
 * Time: 12:13
 */

namespace ZfMetal\EmailCampaigns\Service;

use Exception;
use ZfMetal\EmailCampaigns\Entity\DistributionRecord;
use ZfMetal\EmailCampaigns\Entity\Template;
use ZfMetal\EmailCampaigns\Options\ModuleOptions;
use ZfMetal\EmailCampaigns\Service\Model\CampaignObjects;
use ZfMetal\Mail\MailManager;

class CampaignMailService
{
    /**
     * @var MailManager
     */
    private $mailManager;

    /**
     * @var ModuleOptions
     */
    private $moduleOptions;

    /**
     * @var CampaignObjects
     */
    private $campaignObject;

    /**
     * @var DistributionRecord
     */
    private $distributionRecord;

    /**
     * CampaignMailService constructor.
     * @param MailManager $mailManager
     * @param ModuleOptions $moduleOptions
     */
    public function __construct(MailManager $mailManager, ModuleOptions $moduleOptions)
    {
        $this->mailManager = $mailManager;
        $this->moduleOptions = $moduleOptions;
    }

    /**
     * @return ModuleOptions
     */
    private function getModuleOptions()
    {
        return $this->moduleOptions;
    }

    /**
     * @return CampaignObjects
     */
    private function getCampaignObject()
    {
        return $this->campaignObject;
    }

    /**
     * @return MailManager
     */
    private function getMailManager()
    {
        return $this->mailManager;
    }

    /**
     * @return DistributionRecord
     */
    public function getDistributionRecord()
    {
        return $this->distributionRecord;
    }

    public function with(CampaignObjects $campaignObjects)
    {
        $this->campaignObject = $campaignObjects;
        return $this;
    }

    /**
     * @param DistributionRecord $distributionRecord
     * @return bool
     * @throws Exception
     */
    public function sendEmail(DistributionRecord $distributionRecord)
    {
        try {
            $this->distributionRecord = $distributionRecord;
            $this->prepareEmailTemplate();
            $this->prepareEmailHeader();
            $this->addAttachedFiles();
            if ($this->getMailManager()->send()) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param Template $template
     * @return bool|string
     * @throws Exception
     */
    public
    function getHtmlTemplateFromFile(Template $template)
    {
        $path = $this->getPathTemplateFile($template);
        return file_get_contents($path);
    }

    /**
     * @param $distributionRecord
     * @param $htmlTemplate
     * @return mixed
     */
    public
    function replaceTagsByDistributionRecordFields($distributionRecord, $htmlTemplate)
    {
        $distributionRecordFields = $this->getModuleOptions()->getDistributionRecordFields();
        foreach ($distributionRecordFields as $key => $value) {
            $htmlTemplate = str_replace($key, $distributionRecord->__get($value), $htmlTemplate);
        }
        return $htmlTemplate;
    }

    /**
     * @param Template $template
     * @return null|string
     * @throws Exception
     */
    private
    function getPathTemplateFile(Template $template)
    {
        $path = $template->getFile_fp();

        if (!file_exists($path)) {
            $path = $template->getFile();
            if (!file_exists($path)) {
                throw new Exception("File $path not found");
            }
        }

        return $path;
    }

    /**
     * @param $distributionRecord
     * @throws Exception
     */
    private function prepareEmailTemplate()
    {
        if ($this->getCampaignObject() == null) {
            throw new Exception("Campaign Object Null");
        }
        $distributionRecord = $this->getDistributionRecord();
        $template = $this->getHtmlTemplateFromFile($this->getCampaignObject()->getTemplate());
        $template = $this->replaceTagsByDistributionRecordFields($distributionRecord, $template);

        $this->getMailManager()->addHtmlContentToBody($template);
        $this->getMailManager()->addTemplateWithParams('zf-metal/email-campaigns/template/unsubscribe', [
            'url' => $this->getUrlForUnsubscribe($this->getCampaignObject()->getDistributionlist()->getId(), $distributionRecord->getId())
        ]);
    }

    private function getUrlForUnsubscribe($list, $subs)
    {
        return $this->getModuleOptions()->getUrlDomain() . 'email-campaigns/unsubscribe/' . $list . '/' . $subs;
    }

    private function prepareEmailHeader()
    {
        $distributionRecord = $this->getDistributionRecord();
        $this->getMailManager()->setFrom($this->getCampaignObject()->getDistributionlist()->getOriginEmail());
        $this->getMailManager()->setTO($distributionRecord->getEmail(), $distributionRecord->getFirstName() . ' ' . $distributionRecord->getLastName());
        $this->mailManager->setSubject($this->getCampaignObject()->getCampaign()->getSubject());
    }

    private function addAttachedFiles()
    {
        $attachedFiles = $this->getCampaignObject()->getAttachedFiles();
        for ($i = 0; $i < count($attachedFiles); $i++) {
            $this->getMailManager()->attachFile($attachedFiles[$i]->getName(), $attachedFiles[$i]->getFile());
        }
    }

}