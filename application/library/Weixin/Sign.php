<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Fan Yitian. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Sign.php
 * @author fanyitian (yitian920@163.com)
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
     * 获取微信配置
     * @return array
     */
    private function _getOptions()
    {
        $options = array(
            'token'     => $this->options['token'],
            'appid'     => $this->options['appid'],
            'appsecret' => $this->options['appsecret'],
        );

        return $options;
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
        $options = $this->_getOptions();
        $we_obj = new Wechat($options);

        $arrSigns = $we_obj->getJsSign($url);

        return $arrSigns;
    }

    public function getUnionId()
    {

    }

}
