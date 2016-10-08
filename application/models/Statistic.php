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
//        $allSkuNum = 1865;
        $allSkuNum = PrizeModel::Instance()->getOnlineSkuSum();

        $nowSkuNum = PrizeModel::Instance()->getSkuSum();

        return [
            'sku_all'     => intval($allSkuNum),
            'sku_now'     => intval($nowSkuNum),
            'sku_percent' => round($nowSkuNum * 100 / $allSkuNum, 2) . '%',
        ];
    }

    protected function getUserLog()
    {
        $logList = LogModel::Instance()->getListForCount();
        $arrSum = [];
        foreach ($logList as $item) {
            $date = $item['tt'];
            $type = $item['type'];
            $arrSum[$date][$type] = $item['count'];
            $arrSum[$date][$type . '_distinct'] = $item['count_distinct'];
        }
        return $arrSum;
    }

    public function day()
    {
        $arrResult = [];

        // 获取每日纯新增
        $actList = ActivityModel::Instance()->getList();
        $arrTmpList = [];
        foreach ($actList as $item) {
            $date = date('Y-m-d', strtotime($item['create_time']));
            $openId = $item['openid'];

            $arrTmpList[$date][$openId] = $openId;
        }
        $arrDiff = [];
        $allDiff = 0;
        $arrHistoryOpenId = [];
        foreach ($arrTmpList as $date => $item) {
            if ($date === '2016-09-22') {
                continue;
            }
            $lastDate = date('Y-m-d', strtotime($date) - 86400);
            $lastList = isset($arrTmpList[$lastDate]) ? $arrTmpList[$lastDate] : [];
            $arrHistoryOpenId = array_merge($arrHistoryOpenId, $lastList);

            $diff = array_diff($item, $arrHistoryOpenId);

            $arrDiff[$date] = count($diff);
            $allDiff += $arrDiff[$date];
        }

        $arrUserLog = $this->getUserLog();
        krsort($arrUserLog);

        $arrData = [];
        $all = [];
        foreach ($arrUserLog as $date => $item) {
            if ($date === '2016-09-22') {
                continue;
            }
            $dateVal = [
                'PV'      => $item['pv'],
                '参与数'     => $item['wined'] + $item['not_win'],
                '未中奖'     => $item['not_win'],
                '中奖'      => $item['wined'],
                '核销'      => $item['check'],
                '每日净新增人数' => isset($arrDiff[$date]) ? $arrDiff[$date] : 0,
            ];

            $all['PV'] += $dateVal['PV'];
            $all['参与数'] += $dateVal['参与数'];
            $all['未中奖'] += $dateVal['未中奖'];
            $all['中奖'] += $dateVal['中奖'];
            $all['核销'] += $dateVal['核销'];

            $arrData[$date] = $dateVal;
        }

        $arrResult = $arrData;
        $arrResult['总数'] = $all;
        $arrResult['总数']['每日净新增人数'] = $allDiff;

        return $arrResult;
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