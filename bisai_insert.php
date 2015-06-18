<?php
require_once 'include/common.inc.php';
$now = date("Y-m-d H:i:s");
if($_REQUEST['act']=='save')
{
$year=$_REQUEST['year'];
$xueqi=$_REQUEST['xueqi'];
$sid=$_REQUEST['sid'];
$name=$_REQUEST['name'];
$leibie=$_REQUEST['leibie'];
$classname = $_REQUEST['classname'];
$jibie_re=$_REQUEST['jibie_re'];
$prizename=$_REQUEST['prizename'];
$prizegrade=$_REQUEST['prizegrade'];
$prizedate=$_REQUEST['prizedate'];
if($jibie_re && $prizename && $prizegrade)
{
$sql="insert into sbisai_prize (`id`,`class`,`name`,`sid`,`leibie`,`prizeyear`,`prizexueqi`,`prizedate`,`level`,`prizename`,`prizegrade`,`addtime`) values (NULL,'$classname','$name','$sid','$leibie','$year','$xueqi','$prizedate','$jibie_re','$prizename','$prizegrade','$now')";
$a=$yiqi_db->query($sql);
if($a)
{
$str.=$name."的竞赛获奖数据写入成功！";
}
}
if($str)
	exit($str);
else
	exit("录入失败，请确认参数正确");

}else
	exit("录入失败，请与管理员联系");
?>