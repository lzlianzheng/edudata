<?php
require_once 'include/common.inc.php';
$now = date("Y-m-d H:i:s");
if($_REQUEST['act']=='xieru')
{
$sid=$_REQUEST['sid'];
$name=$_REQUEST['name'];
$classname=$_REQUEST['classname'];
$grade=$_REQUEST['grade'];
$personalgrade=$_REQUEST['personalgrade'];
if($personalgrade && $grade)
{
$sql="insert into social_practice (`id`,`class`,`name`,`sid`,`year`,`xueqi`,`grade`,`personalgrade`,`addtime`) values (NULL,'$classname','$name','$sid','','','$grade','$personalgrade','$now')";
$a=$yiqi_db->query($sql);
if($a)
{
$str.=$name."的社会实践评定数据写入成功！";
}
}
else
{
echo "<script type=text/javascript>alert('社会实践等级不能为空！');window.history.go(-1);</script>";exit;
}
if($str)
{
echo "<script type=text/javascript>alert('$str');window.history.go(-1);</script>";exit;
}
}
?>