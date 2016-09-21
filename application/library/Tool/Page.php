<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Fan Yitian. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Page.php
 * @author fanyitian (yitian920@163.com)
 * @date   2016-05-16
 * @brief
 *
 **/
namespace Tool;

class Page
{
    static public $instance;

    /**
     * @return Page
     */
    static public function Instance()
    {
        $class = get_called_class();
        if (empty(self::$instance)) {
            self::$instance = new $class();
        }

        return self::$instance;
    }

    /**
     * 根据总数据量获取分页信息
     *
     * @param $page
     * @param $itemCount
     * @param int $perPage
     *
     * @return array
     */
    public function getPageInfoByItemCount($page, $itemCount, $perPage = 10)
    {
        $pageCount = ceil($itemCount / $perPage);

        return $this->getPageInfo($page, $pageCount);
    }

    /**
     * 获取分页信息
     *
     * @param int $page      页码
     * @param int $pageCount 总页数
     *
     * @return array
     */
    public function getPageInfo($page, $pageCount)
    {
        $pageInfo = [
            'pre'        => 1,
            'next'       => 1,
            'start'      => 1,
            'end'        => 1,
            'page'       => $page,
            'page_count' => $pageCount,
        ];

        if ($page > 1) {
            $pageInfo['pre'] = $page - 1;
        }

        if ($pageCount < 10) {
            $pageInfo['end'] = $pageCount;
        } else if ($page <= 5) {
            $pageInfo['end'] = 10;
        } else if ($page + 5 < $pageCount) {
            $pageInfo['end'] = $page + 5;
        } else {
            $pageInfo['end'] = $pageCount;
        }

        if ($pageInfo['end'] - 10 > 0) {
            $pageInfo['start'] = $pageInfo['end'] - 9;
        }

        if ($page >= $pageCount) {
            $pageInfo['next'] = $pageCount;
        } else {
            $pageInfo['next'] = $page + 1;
        }

        return $pageInfo;
    }
}