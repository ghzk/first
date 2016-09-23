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
use Models\Base;

class PrizeModel extends Base
{

    const TABLE_PRIZE = 'prize';
    const TABLE_PRIZE_ONLINE = 'prize_online';

    // 是否删除
    const IS_DELETE = 1;
    const NOT_DELETE = 0;

    // 七牛存储host
    const QINIU_HOST = 'http://odwgdo6a0.bkt.clouddn.com';

    const LOCATION_PREF = '静安嘉里中心';
    const LOCATION_EN_PREF = 'Jing An Kerry Centre ';

    /**
     * @return PrizeModel
     */
    static public function Instance()
    {
        return parent::Instance();
    }

    public function __construct()
    {
    }

    /**
     * @param $logo
     *
     * @return string
     */
    private function _buildLogo($logo)
    {
        return !empty($logo) ? self::QINIU_HOST . '/' . $logo : '';
    }

    private function _buildLocation($location)
    {
        return !empty($location) ? self::LOCATION_PREF . $location : '';
    }

    private function _buildLocationEn($locationEn)
    {
        return !empty($locationEn) ? self::LOCATION_EN_PREF . $locationEn : '';
    }

    /**
     * Get All Prize
     * @return array|static[]
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getAllPrizeList()
    {
        $arrList = $this->db()
            ->table(self::TABLE_PRIZE)
            ->select('*')
            ->where('is_delete', '=', self::NOT_DELETE)
            ->get();

        $arrResult = [];
        foreach ($arrList as $item) {

            $item['logo'] = $this->_buildLogo($item['logo']);
            $item['location'] = $this->_buildLocation($item['location']);
            $item['location_en'] = $this->_buildLocationEn($item['location_en']);
            $arrResult[] = $item;
        }

        return $arrResult;
    }

    /**
     * 获取所有奖品logo
     * @return array
     */
    public function getAllPrizeLogo()
    {
        $arrPrize = $this->getAllPrizeList();

        $arrLogo = [];
        foreach ($arrPrize as $item) {
            $arrLogo[] = $item['logo'];
        }

        return $arrLogo;
    }

    /**
     * 获取单个奖品
     *
     * @param $intPrizeId
     *
     * @return mixed|static
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getOnePrize($intPrizeId)
    {
        $arrOne = $this->db()
            ->table(self::TABLE_PRIZE)
            ->where('is_delete', '=', self::NOT_DELETE)
            ->find($intPrizeId);

        if (!empty($arrOne)) {
            $arrOne['logo'] = $this->_buildLogo($arrOne['logo']);
            $arrOne['location'] = $this->_buildLocation($arrOne['location']);
            $arrOne['location_en'] = $this->_buildLocationEn($arrOne['location_en']);
        }

        return $arrOne;
    }

    /**
     * 获取sku总库存量
     * @return mixed
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getSkuSum()
    {
        return $this->db()
            ->table(self::TABLE_PRIZE)
            ->where('is_delete', '=', self::NOT_DELETE)
            ->sum('sku');
    }

    /**
     * @return mixed
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getOnlineSkuSum()
    {
        return $this->db()
            ->table(self::TABLE_PRIZE_ONLINE)
            ->where('is_delete', '=', self::NOT_DELETE)
            ->sum('sku');
    }

    /**
     * 库存减1
     *
     * @param $intPrizeId
     *
     * @return int
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function decreasePrize($intPrizeId)
    {
        $bolRes = $this->db()
            ->table(self::TABLE_PRIZE)
            ->where('id', '=', $intPrizeId)
            ->decrement('sku');

        return $bolRes;
    }


    /**
     * 获取中奖的产品id
     *
     * @param int $intIgnorePrizeId 忽略的产品id
     *
     * @return null
     */
    public function getWinPrizeId($intIgnorePrizeId = 0)
    {
        $arrPrizeList = $this->getAllPrizeList();
        // 把库存计算到总量里, 从总量中随机get到一个商品

        $arrIdSkuMap = [];
        foreach ($arrPrizeList as $item) {
            // 过滤id
            if (!$intIgnorePrizeId && $item['id'] === $intIgnorePrizeId) {
                continue;
            }

            if ($item['sku'] > 0) {
                for ($i = 0; $i < $item['sku']; $i++) {
                    $uniqId = $item['id'] . '_' . $i;
                    $arrIdSkuMap[$uniqId] = $uniqId;
                }
            }
        }

        $arrPrizeIdSku = !empty($arrIdSkuMap) ? explode('_', array_rand($arrIdSkuMap)) : [];

        return isset($arrPrizeIdSku[0]) ? $arrPrizeIdSku[0] : null;
    }


}