<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Fan Yitian. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Activity.php
 * @author fanyitian (yitian920@163.com)
 * @date   2016-09-16
 * @brief
 *
 **/
use Models\Base;
use Config\Config;

class ActivityModel extends Base
{
    const TABLE_ACTIVITY = 'activity';

    // 状态
    const STATUS_NOT_WIN = 0;   // 未中奖
    const STATUS_WINED = 1;     // 已中奖
    const STATUS_CHECKED = 2;   // 已核销

    // 每天参与次数
    const MAX_JOIN_TIMES = 2;
//    const MAX_JOIN_TIMES = 1000;

    // 累计中奖次数上限, 则降低中奖概率
    const MAX_WINED_TIMES_FALLING = 4;
//    const MAX_WINED_TIMES_FALLING = 1000;

    // 中奖概率
    public static $defaultPrizeOdds = 50;


    /**
     * @return ActivityModel
     */
    static public function Instance()
    {
        return parent::Instance();
    }

    public function __construct()
    {
    }

    /**
     * 获取今日起始结束时间
     * @return array
     */
    public static function getTodayStartEnd()
    {
        return [
            'now'   => date('Y-m-d H:i:s', time()),
            'start' => date('Y-m-d 00:00:00', time()),
            'end'   => date('Y-m-d 00:00:00', time() + 86400),
        ];
    }

    /**
     * 获取今日用户参与列表
     *
     * @param $strOpenId
     *
     * @return array|static[]
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getUserTodayJoinList($strOpenId)
    {
        $todayTime = self::getTodayStartEnd();

        $arrList = $this->db()
            ->table(self::TABLE_ACTIVITY)
            ->select('*')
            ->where('openid', '=', $strOpenId)
            ->where('create_time', '>', $todayTime['start'])
            ->where('create_time', '<', $todayTime['end'])
            ->get();

        return $arrList;
    }

    /**
     * 获取已过期的中奖的列表
     * @return array|static[]
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getExpiredWinedJoinList()
    {
        $expiredTime = date('Y-m-d H:i:s', time() - 86400);

        $arrList = $this->db()
            ->table(self::TABLE_ACTIVITY)
            ->select('*')
            ->where('status', '=', self::STATUS_WINED)
            ->where('create_time', '<', $expiredTime)
            ->get();

        return $arrList;
    }

    /**
     * 获取某个用户参与记录
     *
     * @param $strOpenId
     *
     * @return array|static[]
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getUserJoinList($strOpenId)
    {
        $arrList = $this->db()
            ->table(self::TABLE_ACTIVITY)
            ->select('*')
            ->where('openid', '=', $strOpenId)
            ->get();

        return $arrList;
    }

    /**
     * 获取一条act记录
     *
     * @param $intActId
     *
     * @return mixed|static
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getActById($intActId)
    {
        $arrOne = $this->db()
            ->table(self::TABLE_ACTIVITY)
            ->find($intActId);

        return $arrOne;
    }

    /**
     * 添加参与记录
     *
     * @param $strOpenId
     * @param $intPrizeId
     * @param $intStatus
     *
     * @return bool
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function addActivityJoinInfo($strOpenId, $intPrizeId, $intStatus)
    {
        $arrParams = [
            'openid'      => $strOpenId,
            'prize_id'    => $intPrizeId,
            'status'      => $intStatus,
            'create_time' => date('Y-m-d H:i:s', time()),
        ];
        $intActId = $this->db()
            ->table(self::TABLE_ACTIVITY)
            ->insertGetId($arrParams);

        return $intActId;
    }

    /**
     * 修改状态
     *
     * @param $intActId
     * @param $intStatus
     *
     * @return int
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function updateActStatus($intActId, $intStatus)
    {
        $bolRes = $this->db()
            ->table(self::TABLE_ACTIVITY)
            ->where('id', '=', $intActId)
            ->update([
                'status' => $intStatus
            ]);

        return $bolRes;
    }


    /**
     * 根据中奖概率判断是否中奖
     *
     * @param null $intOdds 中奖概率(0-100)
     *
     * @return bool
     */
    public function _checkWin($intOdds = null)
    {
        $rand = mt_rand(0, 99);
        $intOdds = is_null($intOdds) ? self::$defaultPrizeOdds : $intOdds;

        return $rand < $intOdds ? true : false;
    }


    /**
     * 获取用户剩余抽奖次数
     *
     * @param $strOpenId
     *
     * @return int
     */
    public function getUserRestChance($strOpenId)
    {
        // 获取用户参与次数
        $arrJoinList = $this->getUserTodayJoinList($strOpenId);
        $times = count($arrJoinList);

        $times = min($times, self::MAX_JOIN_TIMES);

        return self::MAX_JOIN_TIMES - $times;
    }

    /**
     * 获取用户中奖概率
     *
     * @param $strOpenId
     *
     * @return int
     */
    public function getUserOdds($strOpenId)
    {
        // 中奖规则:
        //  每人每天抽奖2次上限。
        //  默认中奖率 50%;
        //  累计抽奖4次, 中奖率为30%;
        //  累计中奖4次, 中奖率为0%;

        $arrJoinList = $this->getUserJoinList($strOpenId);

        $intOdds = self::$defaultPrizeOdds;
        if (!empty($arrJoinList)) {
            if (count($arrJoinList) >= self::MAX_WINED_TIMES_FALLING) {
                $intOdds = 30;
            }

            $intWinedTimes = 0;
            foreach ($arrJoinList as $item) {
                if ($item['status'] > self::STATUS_NOT_WIN) {
                    $intWinedTimes++;
                }
            }

            if ($intWinedTimes >= self::MAX_WINED_TIMES_FALLING) {
                $intOdds = 0;
            }
        }

        return $intOdds;
    }


    /**
     * 检查白名单
     *
     * @param $strOpenId
     *
     * @return null
     */
    public function checkWriteOpenId($strOpenId)
    {
        $arrOpenIdConf = Config::get_app_white();
        $strDate = '2016-09-23';
        if (date('Y-m-d', time()) !== $strDate) {
            return null;
        }

        if (!array_key_exists($strOpenId, $arrOpenIdConf)) {
            return null;
        }

        $arrJoinList = $this->getUserTodayJoinList($strOpenId);
        $times = count($arrJoinList);
        if ($times === 0) {
            return isset($arrOpenIdConf[$strOpenId][0]) ? $arrOpenIdConf[$strOpenId][0] : null;
        } else if ($times === 1) {
            return isset($arrOpenIdConf[$strOpenId][1]) ? $arrOpenIdConf[$strOpenId][1] : null;
        } else {
            return null;
        }
    }

    /**
     * 抽奖
     *
     * @param $arrInput
     *
     * @return int|null
     * @throws Exception
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function lucky($arrInput)
    {
        $strOpenId = $arrInput['openid'];
        $arrErrorMap = Config::get_app_error();

        // 获取用户剩余抽奖次数
        $intRestChance = $this->getUserRestChance($strOpenId);
        if ($intRestChance <= 0) {
            throw new Exception($arrErrorMap[10011], 10011);
        }
        $intOdds = $this->getUserOdds($strOpenId);

        $bolWinRes = false;     // 是否中奖
        $intPrizeId = 0;
        $intActId = 0;
        $app = $this->db();
        try {
            $app->beginTransaction();

            $bolWin = $this->_checkWin($intOdds);
            $intPrizeId = PrizeModel::Instance()->getWinPrizeId();

            // 判断是否白名单内openId
            $bolWhite = $this->checkWriteOpenId($strOpenId);
            if ($bolWhite) {
                $bolWin = true;
                $intPrizeId = $bolWhite;
            }

            if ($bolWin && $intPrizeId) {
                // 添加获奖记录
                // 对应奖品库存 -1
                // 添加日志
                $query1 = $this->addActivityJoinInfo($strOpenId, $intPrizeId, self::STATUS_WINED);
                $intActId = $query1;

                $query2 = PrizeModel::Instance()->decreasePrize($intPrizeId);
                $query3 = LogModel::Instance()->add('wined', [
                    'openid'   => $strOpenId,
                    'prize_id' => $intPrizeId,
                ]);
                $bolWinRes = true;
            } else {
                // 未中奖或没有奖品了
                $query1 = $this->addActivityJoinInfo($strOpenId, 0, self::STATUS_NOT_WIN);
                $intActId = $query1;

                $query2 = true;
                $query3 = LogModel::Instance()->add('not_win', [
                    'openid'   => $strOpenId,
                    'prize_id' => 0,
                ]);

                $bolWinRes = false;
            }

            if ($query1 !== false && $query2 !== false && $query3 !== false) {
                $app->commit();
            } else {
                $app->rollBack();
            }
        } catch (Exception $e) {
            $app->rollBack();
            $bolWinRes = false;
        }

        if (!$bolWinRes) {
            throw new Exception($arrErrorMap[10010], 10010);
        }
        $arrResult = [
            'prize_id' => $intPrizeId,
            'act_id'   => $intActId,
        ];

        return $arrResult;
    }

    /**
     * 核验
     *
     * @param $arrInput
     *
     * @return bool
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function check($arrInput)
    {
        $intActId = intval($arrInput['act_id']);
        $strOpenId = $arrInput['openid'];
        $intCode = intval($arrInput['code']);
        $intPrizeId = intval($arrInput['prize_id']);

        $bolRes = false;
        $app = $this->db();
        try {
            $app->beginTransaction();

            // 修改act状态: status = 2
            $query1 = $this->updateActStatus($intActId, self::STATUS_CHECKED);

            // 添加日志
            $query2 = LogModel::Instance()->add('check', [
                'openid'     => $strOpenId,
                'prize_id'   => $intPrizeId,
                'check_code' => $intCode,
            ]);

            if ($query1 !== false && $query2 !== false) {
                $app->commit();
                $bolRes = true;
            } else {
                $app->rollBack();
            }
        } catch (Exception $e) {
            $app->rollBack();
        }

        return $bolRes;
    }


}
