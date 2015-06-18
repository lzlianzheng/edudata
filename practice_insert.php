<?php
require_once 'include/common.inc.php';
$now = date("Y-m-d H:i:s");
if($_REQUEST['act']=='save')
{
	$year=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$sid=$_REQUEST['sid'];
	$name=$_REQUEST['name'];
	$classname = $_REQUEST['classname'];
	$jibie_re=$_REQUEST['jibie_re'];
	$grade=$_REQUEST['grade'];
	$sql="insert into social_practice (`id`,`class`,`name`,`sid`,`year`,`xueqi`,`grade`,`personalgrade`,`addtime`) values (NULL,'$classname','$name','$sid','$year','$xueqi','$grade','$jibie_re','$now')";
	$a=$yiqi_db->query($sql);
	if($a)
	{
	$str = "写入成功！";
	}
	if($str)
		exit($str);
	else
		exit("录入失败，请确认参数正确");

}else
	exit("录入失败，请与管理员联系");
?>