<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Author.php
 * @author fanyitian (fanyitian@baidu.com)
 * @date   2016-05-13
 * @brief
 *  作者信息获取类
 **/
use \Models\Base;

class AuthorModel extends Base
{
    const TABLE_AUTHOR = 'author';

    public function __construct()
    {
    }

    /**
     * @return AuthorModel
     */
    static public function Instance()
    {
        return parent::Instance();
    }

    /**
     * Get Author By name.
     *
     * @param $strName
     *
     * @return array|static[]
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getAuthorByName($strName)
    {
        $arrData = $this->db()
            ->table(self::TABLE_AUTHOR)
            ->select('id')
            ->where('name', '=', $strName)
            ->get();

        $arrAuthor = [];
        foreach ($arrData as $row) {
            $arrAuthor[] = $row['id'];
        }

        return $arrAuthor;
    }

    /**
     * Get Author Info By url.
     *
     * @param string $strUrl
     *
     * @return array|static[]
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getAuthorByUrl($strUrl)
    {
        $arrData = $this->db()
            ->table(self::TABLE_AUTHOR)
            ->select('id')
            ->where('url', 'like', '%' . $strUrl . '%')
            ->get();

        $arrAuthor = [];
        foreach ($arrData as $row) {
            $arrAuthor[] = $row['id'];
        }

        return $arrAuthor;
    }

    /**
     * 获取所有用户
     * @return array|static[]
     * @throws \TheFairLib\Exception\Api\ApiException
     */
    public function getAll()
    {
        $arrData = $this->db()
            ->table(self::TABLE_AUTHOR)
            ->select(['name', 'url'])
            ->get();

        $arrResult = [];
        foreach ($arrData as $row) {
            $strUrl = str_replace('http://', '', $row['url']);
            $strUrl = str_replace('https://', '', $strUrl);
            $strUrl = trim($strUrl, '/');
            $row['url_fix'] = $strUrl;

            $arrResult[] = $row;
        }

        return $arrResult;
    }

}
