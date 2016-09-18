<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Sign.php
 * @author fanyitian (fanyitian@baidu.com)
 * @date   2016-09-18
 * @brief
 *
 **/


namespace Weixin;

class Sign
{
    private $options;

    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * 获取js签名
     *
     * @param $url
     *
     * @return array|bool
     */
    public function getJsSign($url)
    {
        $options = array(
            'token'     => $this->options['token'],
            'appid'     => $this->options['appid'],
            'appsecret' => $this->options['appsecret'],
        );
        $we_obj = new Wechat($options);

        $arrSigns = $we_obj->getJsSign($url);

        return $arrSigns;
    }
}
