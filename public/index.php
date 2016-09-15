<?php
define('APP_PATH', realpath(dirname(__FILE__) . '/../')); /*指向publib上一层*/
require_once(APP_PATH . '/vendor/autoload.php');

$application = new Yaf\Application(APP_PATH . "/conf/application.ini");

$application->bootstrap()->run();
?>
