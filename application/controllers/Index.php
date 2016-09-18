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
        $strOpenId = $arrInput['openid'];
        // @todo: params
        // source


        // 增加一个pv日志
        LogModel::Instance()->add('pv', [
            'openid' => $arrInput['openid'],
            'source' => isset($arrInput['source']) ? $arrInput['source'] : null,
        ]);


        // 剩余抽奖次数
        $intRestChance = ActivityModel::Instance()->getUserRestChance($strOpenId);
        $this->getView()->assign('rest_chance', $intRestChance);

        $this->getView()->assign("body", "Hello Wrold<br/>");
    }

    public function testAction()
    {

    }

}