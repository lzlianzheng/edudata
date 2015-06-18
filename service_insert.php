<?php
require_once 'include/common.inc.php';
$now = date("Y-m-d H:i:s");
if($_REQUEST['act']=='save')
{
$sid=$_REQUEST['sid'];
$name = $_REQUEST['name'];
$classname=$_REQUEST['classname'];
$year=$_REQUEST['year'];
$xueqi=$_REQUEST['xueqi'];
$content=$_REQUEST['content'];
$fuwutime=$_REQUEST['fuwutime'];
$grade=$_REQUEST['grade'];
$sql="insert into vol_service (`id`,`class`,`name`,`sid`,`year`,`xueqi`,`content`,`time`,`grade`,`addtime`) values (NULL,'$classname','$name','$sid','$year','$xueqi','$content','$fuwutime','$grade','$now')";
$a=$yiqi_db->query($sql);
if($a)
{
$str.="写入成功！";
}
if($str)
	exit($str);
else
	exit("录入失败，请确认参数正确");
}else
	exit("录入失败，请与管理员联系");
?>