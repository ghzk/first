<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Fan Yitian, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Base.php
 * @author fanyitian (yitian920@163.com)
 * @date   2016-09-23
 * @brief
 *  脚本基础
 **/
date_default_timezone_set('Asia/Shanghai');
mb_internal_encoding('UTF-8');
if (!defined('APP_PATH')) {
    define('APP_PATH', realpath(dirname(__FILE__) . '/../../')); /*指向publib上一层*/
}
require_once(APP_PATH . '/vendor/autoload.php');
$app = new Yaf\Application(APP_PATH . '/conf/application.ini');
$app->bootstrap();