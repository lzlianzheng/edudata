<?php

define("YIQIINC",preg_replace("/[\/\\\\]{1,}/i", '/', dirname(__FILE__) ));
define("YIQIROOT",preg_replace("/[\/\\\\]{1,}/i", '/', substr(YIQIINC,0,-8) ));
header("content-type:text/html; charset=utf-8");

error_reporting(0);
require_once 'common.func.php';
require_once 'data.class.php';
//require_once 'templets.inc.php';
require_once 'version.php';
if(phpversion() > '5.1.0')
    date_default_timezone_set('Asia/Shanghai');
?>
