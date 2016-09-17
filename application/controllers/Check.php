<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Check.php
 * @author fanyitian (fanyitian@baidu.com)
 * @date   2016-09-17
 * @brief
 *
 **/
use Controller\Base;
use Config\Config;

class CheckController extends Base
{
    protected $needWxAuth = false;

    const EXP_TIME = 86400; // 过期时间

    /**
     * 扫码页面
     */
    public function indexAction()
    {
        $arrInput = $this->arrInput;
        $intActId = intval($arrInput['act_id']);
        $strOpenId = $arrInput['openid'];
        $arrErrorMap = Config::get_app_error();

        if (empty($intActId) || empty($strOpenId)) {
            // 参数不合法
            throw new Exception($arrErrorMap[10020], 10020);
        }
        $arrAct = ActivityModel::Instance()->getActById($intActId);
        $intTime = strtotime($arrAct['create_time']);
        if (empty($arrAct)) {
            throw new Exception($arrErrorMap[10020], 10020);
        }

        if ($strOpenId !== $arrAct['openid'] || (time() - $intTime) > self::EXP_TIME) {
            // 伪造或二维码已过期
            throw new Exception($arrErrorMap[10021], 10021);
        }

        // display...
    }

    /**
     * 核验接口
     */
    public function codeAction()
    {
        // params:
        //  act_id
        //  openid
        //  code
    }
}