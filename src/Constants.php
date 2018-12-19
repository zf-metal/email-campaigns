<?php
namespace ZfMetal\EmailCampaigns;

class Constants
{
  const ENTITY_CAMPAIGN         = \ZfMetal\EmailCampaigns\Entity\Campaign::class;
  const ENTITY_CAMPAIGN_STATE   = \ZfMetal\EmailCampaigns\Entity\CampaignState::class;
  const CAMPAIGN_NEW            = 1;
  const CAMPAIGN_TAKED          = 2;
  const CAMPAIGN_ACTIVATED      = 3;
  const CAMPAIGN_IN_PROCESS     = 4;
  const CAMPAIGN_FINISHED       = 5;
  const CAMPAIGN_FAILED         = 6;

  const CAMPAIGN_RECORD_NEW     = 1;
  const CAMPAIGN_RECORD_PROCESS = 2;
  const CAMPAIGN_RECORD_FAILED  = 4;

  const SUBSCRIPTION_ACTIVE     = 1;
  const SUBSCRIPTION_INACTIVE   = 0;
}
