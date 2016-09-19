<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Check.php
 * @author fanyitian (fanyitian@baidu.com)
 * @date   2016-09-17
 * @brief
 *
 **/
use Controller\Base;
use Config\Config;

class CheckController extends Base
{
    protected $needWxAuth = false;

    const EXP_TIME = 86400; // 过期时间

    /**
     * 扫码页面
     */
    public function indexAction()
    {
        $arrInput = $this->arrInput;
//        $arrInput = $this->_checkParams($arrInput);

        // display...
    }

    /**
     * 核验接口
     */
    public function codeAction()
    {
        $arrInput = $this->arrInput;
        $arrInput = $this->_checkParams($arrInput, true);
        $arrErrorMap = Config::get_app_error();

        $bolRes = ActivityModel::Instance()->check($arrInput);
        if (!$bolRes) {
            $this->showError($arrErrorMap[10030], 10030);
        } else {
            $this->showResult([], '核验成功');
        }
    }

    /**
     * 检查参数
     *
     * @param $arrInput
     * @param bool $bolCheckCode
     *
     * @return mixed
     * @throws Exception
     */
    private function _checkParams($arrInput, $bolCheckCode = false)
    {
        $intActId = intval($arrInput['act_id']);
        $strOpenId = $arrInput['openid'];
        $intCode = intval($arrInput['code']);
        $arrErrorMap = Config::get_app_error();

        $errCodeInvalidQrCode = 10020;
        $errCodeExpQrCode = 10021;
        $errCodeStatusUnWin = 10022;
        $errCodeStatusChecked = 10023;
        $errCodeInValidCode = 10024;

        if (empty($intActId) || empty($strOpenId)) {
            throw new Exception($arrErrorMap[$errCodeInvalidQrCode], $errCodeInvalidQrCode);
        }
        if ($bolCheckCode && empty($intCode)) {
            throw new Exception($arrErrorMap[$errCodeInValidCode], $errCodeInValidCode);
        }


        $arrAct = ActivityModel::Instance()->getActById($intActId);
        if (empty($arrAct)) {
            throw new Exception($arrErrorMap[$errCodeInvalidQrCode], $errCodeInvalidQrCode);
        }
        if ($strOpenId !== $arrAct['openid']) {
            // 伪造
            throw new Exception($arrErrorMap[$errCodeInvalidQrCode], $errCodeInvalidQrCode);
        }
        $intTime = strtotime($arrAct['create_time']);
        if ((time() - $intTime) > self::EXP_TIME) {
            // 二维码已过期
            throw new Exception($arrErrorMap[$errCodeExpQrCode], $errCodeExpQrCode);
        }

        // 检查状态
        switch ($arrAct['status']) {
            case ActivityModel::STATUS_NOT_WIN:
                throw new Exception($arrErrorMap[$errCodeStatusUnWin], $errCodeStatusUnWin);
                break;
            case ActivityModel::STATUS_CHECKED:
                throw new Exception($arrErrorMap[$errCodeStatusChecked], $errCodeStatusChecked);
                break;
            default:
                break;
        }

        // 检查code
        if ($bolCheckCode) {
            // 检查prizeId对应的code
            $intPrizeId = $arrAct['prize_id'];
            $arrPrizeInfo = PrizeModel::Instance()->getOnePrize($intPrizeId);

            if ($intCode !== intval($arrPrizeInfo['code'])) {
                throw new Exception($arrErrorMap[$errCodeInValidCode], $errCodeInValidCode);
            }
            $arrInput['prize_id'] = $intPrizeId;
        }

        return $arrInput;
    }

}