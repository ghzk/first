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

    // 是否删除
    const IS_DELETE = 1;
    const NOT_DELETE = 0;

    // 七牛存储host
    const QINIU_HOST = 'http://odqoj6uu3.bkt.clouddn.com';


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
            $arrResult[] = $item;
        }

        return $arrResult;
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

        !empty($arrOne) && $arrOne['logo'] = $this->_buildLogo($arrOne['logo']);

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