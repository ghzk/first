<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Search.php
 * @author fanyitian (fanyitian@baidu.com)
 * @date   2016-05-05
 * @brief
 *
 **/
use Controller\Base;

class SearchController extends Base
{
    public function indexAction()
    {
        $q = $this->getRequest()->getQuery('q');
        $page = $this->getRequest()->getQuery('p');
        $page = max(intval($page), 1);

        $arrInput = [
            'q'    => $q,
            'page' => $page,
        ];

        // php site:baidu.com test
        $pattern = '/(?<q>.+\s)?(?<type>\w+):(?<key>\S+)\s?(?<tail>.+)?/';
        preg_match($pattern, $q, $matches);
        if ($matches) {
            $arrInput['type'] = $matches['type'];
            $arrInput['key'] = $matches['key'];
            $arrInput['word'] = isset($matches['q']) ? $matches['q'] : '';
            $arrInput['word'] .= isset($matches['tail']) ? $matches['tail'] : '';
        }

        $arrArticles = SearchModel::Instance()->search($arrInput);
        $arrAuthor = AuthorModel::Instance()->getAll();

        $this->setDefaultViewTitle($q);
        $this->assign('q', $q);
        $this->assign('page_info', $arrArticles['page_info']);
        $this->assign('item_list', $arrArticles['item_list']);
        $this->assign('author_list', $arrAuthor);
        $this->display();
    }

    public function testAction()
    {

        return false;
    }

}