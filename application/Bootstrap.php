<?php

/**
 * @name Bootstrap
 * @author fanyitian
 * @desc   所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see    http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Yaf\Bootstrap_Abstract
{
    public function _initVendor(Yaf\Dispatcher $dispatcher)
    {
        define('APP_NAME', 'first');
        define('VIEW_PATH', APP_PATH . '/application/views/');
    }

    public function _initConfig()
    {
        //把配置保存起来
        $arrConfig = Yaf\Application::app()->getConfig();
        Yaf\Registry::set('config', $arrConfig);
    }

    public function _initPlugin(Yaf\Dispatcher $dispatcher)
    {
        //注册一个插件
        $objSamplePlugin = new SamplePlugin();
        $dispatcher->registerPlugin($objSamplePlugin);
    }

    public function _initRoute(Yaf\Dispatcher $dispatcher)
    {
        //在这里注册自己的路由协议,默认使用简单路由
    }

    public function _initView(Yaf\Dispatcher $dispatcher)
    {
        //在这里注册自己的view控制器，例如smarty,firekylin
    }

    public function _initLocalName()
    {
        Yaf\Loader::getInstance()->registerLocalNamespace(array(
            'Smarty',
        ));
    }

    public function _initSmarty(Yaf\Dispatcher $dispatcher)
    {
        /* init smarty view engine */
        Yaf\Loader::import("Smarty/Adapter.php");
        $smarty = new Smarty_Adapter(null, Yaf\Application::app()->getConfig()->smarty);
        $dispatcher->setView($smarty);
    }
}
