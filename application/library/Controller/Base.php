<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Fan Yitian. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Base.php
 * @author fanyitian (yitian920@163.com)
 * @date   2016-05-05
 * @brief
 *
 **/
namespace Controller;

use Yaf\Controller_Abstract as Controller;
use Yaf\Dispatcher;
use Response\Response;
use Weixin\Auth;
use Config\Config;
use Exception;

class Base extends Controller
{
    protected $needWxAuth = true;   // 是否需要微信授权登陆获取openid
    protected $arrInput = array();

    /**
     * Controller的init方法会被自动首先调用
     */
    public function init()
    {
        $arrInputGet = $this->getRequest()->getQuery();
        $arrInputPost = $this->getRequest()->getPost();
        $arrInputGet = is_array($arrInputGet) ? $arrInputGet : [];
        $arrInputPost = is_array($arrInputPost) ? $arrInputPost : [];
        $this->arrInput = array_merge($arrInputGet, $arrInputPost);

        $this->setWxUser();
    }

    /**
     * 设置微信用户信息
     * @throws Exception
     */
    protected function setWxUser()
    {
        if ($this->needWxAuth) {
            $arrWxConf = Config::get_app_wechat();
            if (empty($arrWxConf)) {
                throw new Exception('wechat config not found.');
            }
            $arrOptions = [
                'token'     => $arrWxConf['token'],
                'appid'     => $arrWxConf['appid'],
                'appsecret' => $arrWxConf['appsecret'],
            ];

            $auth = new Auth($arrOptions);
            if (empty($auth->open_id)) {
                throw new Exception('wechat get_user_info failed.');
            }
            $this->arrInput['openid'] = $auth->open_id;
        }
    }


    /**
     * Assign values to View engine
     *
     * @param $name
     * @param $value
     *
     * @return bool
     */
    protected function assign($name, $value)
    {
        return $this->getView()->assign($name, $value);
    }

    /**
     * @param string $tplName
     *
     * @return bool
     */
    protected function display($tplName = '')
    {
        $_display = $this->getRequest()->getQuery('__display');
        if ($_display && $_display == 'json') {
            $vars = $this->getView()->__get();
            $this->showResult($vars);
        } else {
            if (empty($tplName)) {
                $tplName = $this->getRequest()->getActionName();
            }

            return parent::display($tplName);
        }
    }


    public function showResult($result, $msg = '', $code = 0)
    {
        $body = array(
            'code'    => $code,
            'message' => $msg,
            'result'  => $result,
        );
        Response::Json($body);
    }

    public function showError($error, $code = 10000, $result = array())
    {
        $this->showResult($result, $error, $code);
    }

}
