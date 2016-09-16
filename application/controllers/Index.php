<?php
/**
 * @name IndexController
 * @author fanyitian
 * @desc   默认控制器
 * @see    http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
use Controller\Base;
use Weixin\Auth;
use Config\Config;

class IndexController extends Base
{
    public function indexAction()
    {
        echo "<pre>";
        print_r($this->arrInput);
        exit;

        $this->getView()->assign("body", "Hello Wrold<br/>");
    }

    public function testAction()
    {

    }

}