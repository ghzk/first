<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Fan Yitian. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Prize.php
 * @author fanyitian (yitian920@163.com)
 * @date   2016-09-16
 * @brief
 *
 **/
use Controller\Base;
use Config\Config;
use Tool\Mqrcode;

class PrizeController extends Base
{
    public function indexAction()
    {
    }

    /**
     * 抽奖接口
     */
    public function luckyAction()
    {
        $this->_checkStart();

        $arrInput = $this->arrInput;
        $strOpenId = $arrInput['openid'];

        $arrInfo = ActivityModel::Instance()->lucky($arrInput);
        $intPrizeId = $arrInfo['prize_id'];
        $intActId = $arrInfo['act_id'];

        $arrPrize = PrizeModel::Instance()->getOnePrize($intPrizeId);
        $qrcode = $this->_buildQrCode($strOpenId, $intActId);

        $this->showResult([
            'prize'  => $arrPrize,
            'qrcode' => $qrcode,
        ]);
    }

    /**
     * 检查活动时间
     * @throws Exception
     */
    private function _checkStart()
    {
        $arrErrorMap = Config::get_app_error();

        $date = '2016-09-22 10:00:00';
        if (time() <= strtotime($date)) {
            throw new Exception($arrErrorMap[10404], 10404);
        }
    }

    /**
     * 构建二维码
     *
     * @param $openId
     * @param $actId
     *
     * @return string
     */
    private function _buildQrCode($openId, $actId)
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/check/index';
        $params = [
            'act_id' => $actId,
            'openid' => $openId,
        ];
        $url = $host . '?' . http_build_query($params);
        $qrcode = Mqrcode::Instance()->get($url);

        return $qrcode;
    }

    public function listAction()
    {
        $arrPrize = PrizeModel::Instance()->getAllPrizeList();

        $this->showResult($arrPrize);
    }
}