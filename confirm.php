<?php
require_once 'include/common.inc.php';
$name = $_GET['username'];
$oldpwd = md5($_GET['oldpwd']);
$newpwd = md5($_GET['newpwd']);
$sql = "select * from user where sid = $name";
$data = $yiqi_db->get_row($sql);
if($data)
{
	if($data->password == $oldpwd)
	{
	$sql = "update user set password = '$newpwd' where sid = $name";
	$a=$yiqi_db->query($sql);
	if($a)
	echo "1";
	else
	echo "0";
	}else
	echo "0";
}else
echo "0";

?>