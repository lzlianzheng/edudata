<?php
require_once 'include/common.inc.php';
$class = $_GET["s_class"];
$sql="select * from xuefeng where 1";
if($class)
{
$sql .=" and class= '$class'";
}
$result=$yiqi_db->get_row($sql);
$res1=$yiqi_db->get_results("select * from zige_certificate where class= '$class'");
$res2=$yiqi_db->get_results("select * from zige_certificate where computerfirst='通过' && class= '$class'");
$num1=count($res2)/count($res1)*100;
$res3=$yiqi_db->get_results("select * from zige_certificate where engthirda='通过' || engthirdb='通过' && class= '$class'");
$num2=count($res3)/count($res1)*100;
$res4=$yiqi_db->get_results("select * from zige_certificate where certione!='' || certitwo!='' || certithree!='' || certifour!='' && class= '$class'");
$num3=count($res4)/count($res1)*100;
$number1=number_format($num1, 2, '.', '')."%";
$number2=number_format($num2, 2, '.', '')."%";
$number3=number_format($num3, 2, '.', '')."%";
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
　

<form action="xuefeng.php" method="get" class="disin">
请选择需要统计的班级：<select name='s_class'><option value=''>请选择</option>
<?php
	$classpara=globalpara("class");
	foreach($classpara as $k=>$x){
		$se = ($x == $class)? " selected " : "";
		echo "<option $se value='$x'>$x</option>";
	}
?>
</select>
<input type="submit" value="查询" id="submit" />　　　　　
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list4">
<tr>
	<td>班级</td>
	<td>学年</td>
	<td>学期</td>
	<td>奖学金获得率</td>
	<td>不及格率</td>	
	<td>补考率</td>
	<td>计算机一级通过率</td>
	<td>英语三级通过率</td>
	<td>资格证书持有率</td>
</tr>
<?php
	echo "<tr><td>$result->class</td>
			<td>$result->year</td>
			<td>$result->xueqi</td>
			<td>$result->scholarrate</td>
			<td>$result->bujige</td>
			<td>$result->bukao</td>
			
	" ;
		if($num1>0)
			echo "<td>$number1</td>";
		else 
		echo "<td>暂无数据</td>";
		if($num2>0)
			echo "<td>$number2</td>";
		else 
		echo "<td>暂无数据</td>";
		if($num3>0)
			echo "<td>$number3</td>";
		else 
		echo "<td>暂无数据</td></tr>";
?>
</table>

</div>
</body>
</html>