<?php
/**
 * @name IndexController
 * @author fanyitian
 * @desc   默认控制器
 * @see    http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
use Controller\Base;

class IndexController extends Base
{
    public function indexAction()
    {
        $arrInput = $this->arrInput;
        // @todo: params
        // source


        // 增加一个pv日志
        LogModel::Instance()->add('pv', [
            'openid' => $arrInput['openid'],
            'source' => isset($arrInput['source']) ? $arrInput['source'] : null,
        ]);

        $this->getView()->assign("body", "Hello Wrold<br/>");
    }

    public function testAction()
    {

    }

}