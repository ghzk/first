<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Fan Yitian, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Sample.php
 * @author fanyitian (yitian920@163.com)
 * @date   2016-09-23
 * @brief
 *  释放过期库存脚本
 **/
require_once('./Base.php');

$path = realpath(dirname(__FILE__)) . '/data';
if (!file_exists($path)) {
    @mkdir($path, 0777, true);
}
$file = $path . '/release_' . date('Y-m-d-H-i', time()) . '.log';


/**
 * 获取二维码过期未领取奖品对应数量
 * @return array
 */
function get_exp_act_prize_list()
{
    $actList = ActivityModel::Instance()->getExpiredWinedJoinList();

    $prizeIdCount = [];
    foreach ($actList as $item) {
        $intPrizeId = $item['prize_id'];
        !isset($prizeIdCount[$intPrizeId]) && $prizeIdCount[$intPrizeId] = 0;

        $prizeIdCount[$intPrizeId]++;
    }

    return $prizeIdCount;
}

function log_echo($row)
{
    global $file;

    echo $row;
    file_put_contents($file, $row, FILE_APPEND);
}


function run()
{
    $prizeIdCount = get_exp_act_prize_list();
    if (!empty($prizeIdCount)) {
        // 设置过期状态
        ActivityModel::Instance()->setExpiredWinedStatus();

        foreach ($prizeIdCount as $intPrizeId => $intAmount) {
            $bolRes = PrizeModel::Instance()->incrementPrize($intPrizeId, $intAmount);
            $strRes = $bolRes ? '成功' : '失败';

            log_echo("prizeId: $intPrizeId, \t恢复库存数: $intAmount, \t结果: $strRes" . PHP_EOL);
            sleep(1);
        }
    }
}

log_echo('------脚本start------' . PHP_EOL);
run();
log_echo('------脚本end------' . PHP_EOL);