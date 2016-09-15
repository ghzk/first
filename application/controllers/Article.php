<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Article.php
 * @author fanyitian (fanyitian@baidu.com)
 * @date   2016-05-13
 * @brief
 *
 **/
use Controller\Base;

class ArticleController extends Base
{
    public function indexAction()
    {
        $id = intval($this->getRequest()->getQuery('id'));

        if (empty($id)) {
            throw new \Exception('Article Not Found.');
        }
        $article = ArticleModel::Instance()->getOne($id);
        if (empty($article)) {
            throw new \Exception('Article Not Found.');
        }

        $this->setDefaultViewTitle($article['title']);
        $this->assign('article', $article);
        $this->display();
    }
}
