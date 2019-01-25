<?php

namespace ZfMetal\EmailCampaigns\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZfMetal\Datagrid\Column\ColumnInterface;

/**
 * @author cincarnato
 */
class Pause extends AbstractHelper
{

    /**
     * Invoke helper
     *
     * Proxies to {@link render()}.
     *
     * @param  ColumnInterface $column
     * @param  array $data
     * @return string
     */
    public function __invoke(ColumnInterface $column, array $data)
    {
        if ($data['paused']) {
            $btn = "<a class='btn btn-success' href='/email-campaigns/campaign/pause/" . $data['id'] . "/0'>Play</a>";
        } else {
            $btn = "<a class='btn btn-warning' href='/email-campaigns/campaign/pause/" . $data['id'] . "/1'>Pause</a>";
        }

        return $btn;
    }

}

?>
