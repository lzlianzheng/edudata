<?php
require_once 'include/common.inc.php';
$now = date("Y-m-d H:i:s");
if($_REQUEST['act']=='xieru')
{
$sid=$_REQUEST['sid'];
$name=$_REQUEST['name'];
$classname=$_REQUEST['classname'];
$content=$_REQUEST['content'];
$time=$_REQUEST['time'];
$unit=$_REQUEST['unit'];
if($content)
{
$sql="insert into keji_invent (`id`,`class`,`name`,`sid`,`year`,`xueqi`,`content`,`time`,`unit`,`addtime`) values (NULL,'$classname','$name','$sid','','','$content','$time','$unit','$now')";
$a=$yiqi_db->query($sql);
if($a)
{
$str.=$name."的科技发明数据写入成功！";
}
}
else
{
echo "<script type=text/javascript>alert('科技发明内容不能为空');window.history.go(-1);</script>";exit;
}
if($str)
{
echo "<script type=text/javascript>alert('$str');window.history.go(-1);</script>";exit;
}
}
?>