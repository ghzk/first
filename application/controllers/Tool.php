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
use Weixin\Sign;

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
     * 获取weixin签名
     * @throws Exception
     */
    public function wxsignAction()
    {
        $arrInput = $this->arrInput;
        $url = $arrInput['url'];
        if (empty($url)) {
            throw new Exception('参数错误, url', 10000);
        }

        $arrWxConf = Config::get_app_wechat();
        if (empty($arrWxConf)) {
            throw new Exception('wechat config not found.');
        }
        $arrOptions = [
            'token'     => $arrWxConf['token'],
            'appid'     => $arrWxConf['appid'],
            'appsecret' => $arrWxConf['appsecret'],
        ];

        $objSign = new Sign($arrOptions);
        $arrJsSign = $objSign->getJsSign($url);

        $this->showResult([
            'data' => $arrJsSign,
        ]);
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
