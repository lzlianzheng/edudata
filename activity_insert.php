<?php
require_once 'include/common.inc.php';
$now = date("Y-m-d H:i:s");
if($_REQUEST['act']=='save')
{
	$sid=$_REQUEST['sid'];
	$name=$_REQUEST['name'];
	$classname=$_REQUEST['classname'];
	$activity_name=$_REQUEST['activity_name'];
	$activity_time=$_REQUEST['activity_time'];
	$grade=$_REQUEST['grade'];
	if($activity_name && $grade && $activity_time)
	{
	$sql="insert into activity_join (`id`,`class`,`name`,`sid`,`year`,`xueqi`,`content`,`time`,`activity_grade`,`addtime`) values (NULL,'$classname','$name','$sid','','','$avtivity_name','$activity_time','$grade','$now')";
	$a=$yiqi_db->query($sql);
	if($a)
	{
	$str.=$name."的活动参与数据写入成功！";
	}
	}
	else
	{
	echo "<script type=text/javascript>alert('写入内容不完整');window.history.go(-1);</script>";exit;
	}
	if($str)
	{
	echo "<script type=text/javascript>alert('$str');window.history.go(-1);</script>";exit;
	}
}
?>