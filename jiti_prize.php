<?php
require_once 'include/common.inc.php';
$xueqi=$_GET["xueqi"];
$sql="select class as classname,prizeyear,xueqi,prizedate,prizelevel,prizename,prizegrade from cjiti_prize where xueqi=$xueqi";
$result=$yiqi_db->get_results($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="images/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="images/jquery-1.6.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
});
</script>
<body>
<div class="mainbody">
<div class="menu tc">
　

<form action="jiti_prize.php" method="get" class="disin">
学期<select name='xueqi'><option value=''>请选择</option>";
	<option value="1">第一学期</option>
	<option value="2">第二学期</option>
	</select>
<input type="submit" value="查询" id="submit" />　　　　　
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list4">
<tr>
	<td>班级</td>
	<td>获奖学期</td>
	<td>学期</td>
	<td>获奖日期</td>
	<td>获奖级别</td>	
	<td>奖项名称</td>
	<td>奖项等级</td>
</tr>
<?php
if(count($result) > 0){
	foreach($result as $v){
		echo "<tr>
			<td>$v->classname</td>
			<td>$v->prizeyear</td>
			<td>$v->xueqi</td>
			<td>$v->prizedate</td>
			<td>$v->prizelevel</td>
			<td>$v->prizename</td>
			<td>$v->prizegrade</td>
		</tr>";
	}
}
?>
</table>
</div>
</body>
</html>