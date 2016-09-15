<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Base.php
 * @author fanyitian (fanyitian@baidu.com)
 * @date   2016-05-05
 * @brief
 *
 **/
namespace Controller;

use Yaf\Controller_Abstract as Controller;
use Yaf\Dispatcher;
use Response\Response;

class Base extends Controller
{
    /**
     * Controller的init方法会被自动首先调用
     */
    public function init()
    {
        // 关闭自动渲染
//        Dispatcher::getInstance()->disableView();
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
            'result'  => (object)$result,
        );
        Response::Json($body);
    }

    public function showError($error, $result = array(), $code = 10000)
    {
        $this->showResult($result, $error, $code);
    }

}
