<?php

/**
 * @name ErrorController
 * @desc   错误控制器, 在发生未捕获的异常时刻被调用
 * @see    http://www.php.net/manual/en/yaf-dispatcher.catchexception.php
 * @author fanyitian
 */
use Yaf\Registry;
use Yaf\Dispatcher;

class ErrorController extends Yaf\Controller_Abstract
{

    //从2.1开始, errorAction支持直接通过参数获取异常
    public function errorAction($exception)
    {
        if (Registry::get('config')->environment != 'pro') {
            echo '<pre>';
            print_r($exception);
        }
        Dispatcher::getInstance()->autoRender(false);
        switch ($exception->getCode()) {
            case YAF\ERR\NOTFOUND\MODULE:
            case YAF\ERR\NOTFOUND\CONTROLLER:
            case YAF\ERR\NOTFOUND\ACTION:
            case YAF\ERR\NOTFOUND\VIEW:
            case 404:
                header("Content-type: text/html; charset=utf-8");
                header("status: 404 Not Found");
                $this->display("404");
                break;
            default :
                header("Content-type: text/html; charset=utf-8");
                header("status: 500 Internal Server Error");
                if (Registry::get('config')->environment == 'pro') {
                    $this->display("500", ['msg' => $exception->getMessage()]);
                } else {
                    echo $exception->getMessage();
                }
                break;
        }
    }
}
