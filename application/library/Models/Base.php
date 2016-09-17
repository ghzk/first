<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Base.php
 * @author fanyitian (fanyitian@baidu.com)
 * @date   2016-05-16
 * @brief
 *
 **/
namespace Models;

use Illuminate\Database\Capsule\Manager as Capsule;
use Config\Config;
use \TheFairLib\Exception\Api\ApiException;
use \Predis\Client as Redis;


class Base
{
    static public $instance = array();
    static public $dbName = 'first';

    static protected $capsule;
    static protected $db = [];
    static protected $redis;

    static public function Instance()
    {
        $class = get_called_class();
        if (empty(self::$instance[$class])) {
            self::$instance[$class] = new $class;
        }

        return self::$instance[$class];
    }


    public function __construct()
    {

    }

    protected function redis($redisDB = 'default')
    {
        if (!isset(self::$redis[$redisDB])) {
            $conf = Config::get_db_redis($redisDB);
            if (empty($conf)) {
                throw new ApiException('not found redis conf:' . $redisDB);
            }
            $options = [
                'prefix' => 'blogs:',
            ];

            self::$redis[$redisDB] = new Redis($conf, $options);
        }

        return self::$redis[$redisDB];
    }

    protected function db($dbName = '')
    {
        if (empty($dbName)) {
            $dbName = static::$dbName;
        }

        if (empty(self::$capsule)) {
            self::$capsule = new Capsule();
            self::$capsule->setAsGlobal();
        }

        if (!in_array($dbName, self::$db)) {
            $conf = Config::get_db_mysql($dbName);
            if (empty($conf)) {
                throw new ApiException('sys_db:' . $dbName);
            }

            self::$capsule->addConnection($conf, $dbName);
            self::$capsule->setAsGlobal();
            self::$db[] = $dbName;
        }
        $tmp = self::$capsule;

        return $tmp::connection($dbName);
    }
}