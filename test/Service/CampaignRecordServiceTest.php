<?php
/**
 * Created by IntelliJ IDEA.
 * User: afurgeri
 * Date: 10/12/2018
 * Time: 23:18
 */

namespace Test\Service;


use PHPUnit\Framework\TestCase;
use ZfMetal\EmailCampaigns\Service\CampaignRecordService;


class CampaignRecordServiceTest extends TestCase
{
    public function testCreateInstanceOfService(){
        $campaignRecordService = new CampaignRecordService();
        $this->assertInstanceOf(CampaignRecordService::class, $campaignRecordService);

        return $campaignRecordService;
    }
}