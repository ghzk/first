<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Fan Yitian. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Statistic.php
 * @author fanyitian (yitian920@163.com)
 * @date   2016-09-18
 * @brief
 *
 **/
use Models\Base;

class StatisticModel extends Base
{
    /**
     * @return StatisticModel
     */
    static public function Instance()
    {
        return parent::Instance();
    }

    public function __construct()
    {
    }

    protected function getSku()
    {
        $allSkuNum = 1865;

        $nowSkuNum = PrizeModel::Instance()->getSkuSum();

        return [
            'sku_all'     => $allSkuNum,
            'sku_now'     => intval($nowSkuNum),
            'sku_percent' => round($nowSkuNum * 100 / $allSkuNum, 2) . '%',
        ];
    }

    protected function getUserLog()
    {
        $logList = LogModel::Instance()->getList();


        $arrTmpList = [];

        foreach ($logList as $item) {
            $date = date('Y-m-d', strtotime($item['create_time']));
            $type = $item['type'];

            $arrTmpList[$date][$type][] = $item['openid'];
        }

        $arrSum = [];
        foreach ($arrTmpList as $date => $dateVal) {
            foreach ($dateVal as $type => $openIds) {
                $arrSum[$date][$type] = count($openIds);
                $arrSum[$date][$type . '_distinct'] = count(array_unique($openIds));
            }
        }

        return $arrSum;
    }


    public function summary()
    {
        $arrResult = [];
        $arrResult['prize_odds'] = ActivityModel::$defaultPrizeOdds;

        // 获取prize sku
        $arrResult['sku'] = $this->getSku();

        // 获取user_log
        $historyLog = $this->getUserLog();

        $today = date('Y-m-d');
        $arrResult['today_log'] = isset($historyLog[$today]) ? $historyLog[$today] : [];

        $arrResult['history_log'] = $historyLog;
        return $arrResult;
    }

}