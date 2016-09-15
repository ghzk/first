<?php
/**
 * @name IndexController
 * @author fanyitian
 * @desc   默认控制器
 * @see    http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
use Yaf\Dispatcher;
use Controller\Base;
use Yaf\Controller_Abstract as Controller;

class IndexController extends Controller
{

    public function indexAction()
    {
        $this->getView()->assign("body", "Hello Wrold<br/>");

//        return false;
    }

    public function testAction()
    {

    }

}