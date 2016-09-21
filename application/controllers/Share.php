<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Share.php
 * @author fanyitian (fanyitian@baidu.com)
 * @date   2016-09-21
 * @brief
 *  分享
 **/
use Controller\Base;
use Config\Config;

class ShareController extends Base
{
    /**
     * 分享页面
     */
    public function indexAction()
    {
        $arrInput = $this->arrInput;
        $strOpenId = $arrInput['openid'];

        // 增加一个pv日志
        LogModel::Instance()->add('share', [
            'openid' => $arrInput['openid'],
            'source' => isset($arrInput['source']) ? $arrInput['source'] : null,
        ]);
    }

}