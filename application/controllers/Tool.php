<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Tool.php
 * @author fanyitian (fanyitian@baidu.com)
 * @date   2016-09-16
 * @brief
 *
 **/
use Controller\Base;
use Weixin\CallBackApiTest;
use Config\Config;

class ToolController extends Base
{
    protected $needWxAuth = false;

    public function indexAction()
    {
    }

    /**
     * 统计接口
     */
    public function statisticAction()
    {
        $arrResult = StatisticModel::Instance()->summary();

        $this->showResult($arrResult);
    }

    /**
     * 微信回调
     * @return bool
     */
    public function wxcallbacktestAction()
    {
        $arrWxConf = Config::get_app_wechat();

        define("TOKEN", $arrWxConf['token']);
        $wechatObj = new CallBackApiTest();
        $wechatObj->valid();

        return false;
    }
}
