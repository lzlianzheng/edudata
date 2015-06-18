<?php
require_once 'include/common.inc.php';

$sid = $_REQUEST['sid'];
$sql = "select * from scholarship where sid = $sid";
$data = $yiqi_db->get_row($sql);
//print_r($data);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="images/main.css" rel="stylesheet" type="text/css" media="" />
<link href="images/print2.css" rel="stylesheet" type="text/css" media="print" />
<script type="text/javascript" src="images/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="images/printarea.js"></script>
<body>
<div class="mainbody">
<div class="tc"><a href="scholar_result_update.php?act=sel">返回列表</a><br/></div>
<form action="modify.php" method="post">
<input type="hidden" name="act" value="sch2">
<input type="hidden" name="id" value="<?php echo $data->id;?>">
<table cellspacing="0" cellpadding="0" class="t_list list4">

<tr>
	<td>姓名</td>
	<td><input type="text" name="name" value="<?php echo $data->name; ?>" /></td>
	<td>学号</td>
	<td><input type="text" name="sid" value="<?php echo $data->sid; ?>" /></td>
</tr>
<tr>
	<td>获奖学年</td>
	<td><input type="text" name="year" value="<?php echo $data->year; ?>" /></td>
	<td>获奖学期</td>
	<td><input type="text" name="xueqi" value="<?php echo $data->xueqi; ?>" /></td>
</tr>
<tr>
	<td>获奖等级</td>
	<td><input type="text" name="level" value="<?php echo $data->scholarship; ?>"/></td>
	<td>备注</td>
	<td><input type="text" name="beizhu" value="<?php echo $data->beizhu; ?>" /></td>
</tr>
<tr>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
</div>
</body>
</html>