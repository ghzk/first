<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Log.php
 * @author fanyitian (fanyitian@baidu.com)
 * @date   2016-09-16
 * @brief
 *
 **/
use Models\Base;
use TheFairLib\Utility\Utility;

class LogModel extends Base
{
    const TABLE_USER_LOG = 'user_log';

    /**
     * @return LogModel
     */
    static public function Instance()
    {
        return parent::Instance();
    }

    public function __construct()
    {
    }

    /**
     * 获取日志列表
     * @return array|static[]
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getList()
    {
        $arrList = $this->db()
            ->table(self::TABLE_USER_LOG)
            ->select('*')
            ->get();

        return $arrList;
    }

    /**
     * 添加日志
     *
     * @param $type
     * @param $params
     *
     * @return bool
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function add($type, $params)
    {
        $arrParams = [
            'type'        => $type,
            'create_time' => date('Y-m-d H:i:s', time()),
            'ip'          => Utility::getUserIp(),
        ];
        isset($params['openid']) && $arrParams['openid'] = $params['openid'];
        isset($params['source']) && $arrParams['source'] = $params['source'];
        isset($params['prize_id']) && $arrParams['prize_id'] = $params['prize_id'];
        isset($params['check_code']) && $arrParams['check_code'] = $params['check_code'];

        $bolRes = $this->db()
            ->table(self::TABLE_USER_LOG)
            ->insert($arrParams);

        return $bolRes;
    }
}