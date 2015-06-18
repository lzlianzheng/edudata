<?php
require_once 'include/common.inc.php';
$now = date("Y-m-d H:i:s");
if($_REQUEST['act']=='xieru')
{
$sid=$_REQUEST['sid'];
$name=$_REQUEST['name'];
$classname=$_REQUEST['classname'];
$articlename=$_REQUEST['articlename'];
$publishdate=$_REQUEST['publishdate'];
$kanwuname=$_REQUEST['kanwuname'];
$kanwujibie=$_REQUEST['kanwujibie'];
$gaochou=$_REQUEST['gaochou'];
if($kanwuname)
{
$sql="insert into publish_articles (`id`,`class`,`name`,`sid`,`year`,`xueqi`,`articlename`,`publishdate`,`kanwuname`,`kanwujibie`,`gaochou`,`addtime`) values (NULL,'$classname','$name','$sid','','','$articlename','$publishdate','$kanwuname','$kanwujibie','$gaochou','$now')";
$a=$yiqi_db->query($sql);
if($a)
{
$str.=$name."发表文章的数据写入成功！";
}
}
else
{
echo "<script type=text/javascript>alert('文章名称不能为空');window.history.go(-1);</script>";exit;
}
if($str)
{
echo "<script type=text/javascript>alert('$str');window.history.go(-1);</script>";exit;
}
}
?>