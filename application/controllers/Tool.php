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
use Yaf\Controller_Abstract as Controller;
use Weixin\CallBackApiTest;
use Config\Config;

class ToolController extends Controller
{
    protected $needWxAuth = false;

    public function indexAction()
    {
    }

    public function wxcallbacktestAction()
    {
        $arrWxConf = Config::get_app_wechat();

        define("TOKEN", $arrWxConf['token']);
        $wechatObj = new CallBackApiTest();
        $wechatObj->valid();

        return false;
    }
}
