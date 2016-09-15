<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Article.php
 * @author fanyitian (fanyitian@baidu.com)
 * @date   2016-05-12
 * @brief
 *  文章数据获取类
 **/
use Models\Base;

class ArticleModel extends Base
{
    const TABLE_ARTICLES = 'articles';
    const TABLE_AUTHOR = 'author';

    /**
     * @return ArticleModel
     */
    static public function Instance()
    {
        return parent::Instance();
    }

    public function __construct()
    {
    }

    /**
     * Get Article List By Article Ids.
     *
     * @param $intIds
     *
     * @return array
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getListByIds($intIds = [])
    {
        if (empty($intIds)) {
            return [];
        }
        $arrArticles = $this->db()
            ->table(self::TABLE_ARTICLES)
            ->leftJoin(self::TABLE_AUTHOR, self::TABLE_ARTICLES . '.author_id', '=', self::TABLE_AUTHOR . '.id')
            ->select(self::TABLE_ARTICLES . '.*', self::TABLE_AUTHOR . '.name as author_name')
            ->whereIn(self::TABLE_ARTICLES . '.id', $intIds)
            ->get();

        $arrData = [];
        foreach ($arrArticles as $row) {
            // 对body先做htmlentities处理
            $row['body'] = htmlentities($row['body']);

            $arrData[$row['id']] = $row;
        }

        // 安装参数ids排序
        $arrResult = [];
        foreach ($intIds as $id) {
            if (!isset($arrData[$id])) {
                continue;
            }
            $arrResult[$id] = $arrData[$id];
        }

        return $arrResult;
    }


    /**
     * Get One Article.
     *
     * @param int $intArticleId Article Id.
     *
     * @return array|mixed|static
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getOne($intArticleId)
    {
        $arrArticle = $this->getListByIds([$intArticleId]);
        $arrResult = [];
        if ($arrArticle[$intArticleId]) {
            $arrResult = $arrArticle[$intArticleId];
            $arrResult['body'] = html_entity_decode($arrResult['body']);
        }

        return $arrResult;
    }

    /**
     * Get Article List By Author ids.
     *
     * @param $arrAuthorIds
     * @param int $intPage
     * @param int $intPageSize
     *
     * @return array|static[]
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getListByAuthorIds($arrAuthorIds, $intPage = 1, $intPageSize = 10)
    {
        $intCount = $this->db()
            ->table(self::TABLE_ARTICLES)
            ->whereIn('author_id', $arrAuthorIds)
            ->count();

        $arrData = $this->db()
            ->table(self::TABLE_ARTICLES)
            ->select('id')
            ->whereIn('author_id', $arrAuthorIds)
            ->orderBy('publish_time', 'desc')
            ->forPage($intPage, $intPageSize)
            ->get();

        $arrIds = [];
        foreach ($arrData as $row) {
            $arrIds[] = $row['id'];
        }
        $arrTmpItemList = $this->getListByIds($arrIds);

        $arrItemList = [];
        foreach ($arrIds as $id) {
            if (!isset($arrTmpItemList[$id])) {
                continue;
            }
            $arrItemList[$id] = $arrTmpItemList[$id];
        }

        return [
            'item_count' => $intCount,
            'item_list'  => array_values($arrItemList),
        ];
    }


    /**
     * Get Latest Article Ids Order By Date Desc. limit $limit
     *
     * @param int $limit
     *
     * @return array
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getLatest($limit = 100)
    {
        $arrArticles = $this->db()
            ->table(self::TABLE_ARTICLES)
            ->select('id')
            ->orderBy('publish_time', 'desc')
            ->limit($limit)
            ->get();

        $arrIds = [];
        foreach ($arrArticles as $row) {
            $arrIds[] = $row['id'];
        }

        return $arrIds;
    }

    /**
     * Get Article Ids Order By Date Desc. From Cache
     *
     * @param int $page
     * @param int $pageSize
     *
     * @return array|static[]
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getLatestFromCache($page = 1, $pageSize = 10)
    {
        $key = 'article_order_date_ids';
        $ttl = 60;
//        $ttl = 3600;

        $client = $this->redis();
        if ($client->exists($key)) {
            $strIds = $client->get($key);
            $arrIds = explode(',', $strIds);
        } else {
            $arrIds = $this->getLatest();
            $client->setex($key, $ttl, implode(',', $arrIds));
        }

        $offset = ($page - 1) * $pageSize;
        $arrIds = array_slice($arrIds, $offset, $pageSize);

        $arrArticles = [];
        if ($arrIds) {
            $arrArticles = $this->getListByIds($arrIds);
        }

        return $arrArticles;
    }


}