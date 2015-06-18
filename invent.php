<?php
require_once 'include/common.inc.php';
$yeardata=$yiqi_db->get_results("select distinct year from keji_invent");
$mid=$_GET["s_major"];
$class = $_GET["s_class"];
$xueqi = $_GET["xueqi"];
$sql="select a.*,b.id from keji_invent a left join class b on a.class=b.name where 1";
if($class)
{
$sql .=" and class= '$class'";
}
$sql2 = "select name from class where 1";
$sql2 .= ($syear)? " and year>='$syear' " : "";
$sql2 .= ($eyear)? " and year<='$eyear' " : "";
if($syear || $eyear)
{
$sql .= " and a.class in ($sql2) ";
}
if($xueqi)
{
$sql .= " and xueqi=$xueqi";
}
if($mid){
$sql .=" and majorid=$mid";
}
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
	$("select[name=s_major]").change(function(){
		$.get("jsondata.php?type=stu&mid="+$(this).val(),null,function(data){
			$("select[name=s_class]").html(data);
		});
	});
});
</script>
<body>
<div class="mainbody">
<div class="menu tc">
　

<form action="invent.php" method="get" class="disin">
<input type="hidden" name="act" value="stat">
<?php
	echo "　专业 <select name='s_major'><option value=''>请选择</option>";
	$majorpara=globalpara("major");
	foreach($majorpara as $k=>$v){
		$se = ($k==$mid)? " selected " : "";
		echo "<option $se value='$k'>$v</option>";
	}
	echo "</select>";
	echo "　班级 <select name='s_class'><option value=''>请选择</option>";
	$classpara=globalpara("class");
	
	foreach($classpara as $k=>$x){
		$se = ($k==$class)? " selected " : "";
		echo "<option $se value='$k'>$x</option>";
	}
	echo "</select>";
?>
  学年<select name="xuenian"><option value=''>全部</option>
	<?php
foreach($yeardata as $v){
	$se = ($v->year == $xuenian)? " selected " : "";
	echo "<option $se value='$v->year'>$v->year</option>";
}
?>
  </select>
　学期<select name='xueqi'><option value=''>全部</option>
	<option <?php if($xueqi == 1){echo "selected";} ?> value="1">第一学期</option>
	<option <?php if($xueqi == 2){echo "selected";} ?> value="2">第二学期</option>
	</select>
<input type="submit" value="查询" id="submit" />　　　　　
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list4">
<tr>
	<td>班级</td>
	<td>姓名</td>
	<td>学号</td>
	<td>学年</td>
	<td>学期</td>	
	<td>发明内容</td>
	<td>获得时间</td>
	<td>授予单位</td>
</tr>
<?php
if(count($result) > 0){
	foreach($result as $v){
		echo "<tr>
			<td>$v->class</td>
			<td>$v->name</td>
			<td>$v->sid</td>
			<td>$v->year</td>
			<td>$v->xueqi</td>
			<td>$v->content</td>
			<td>$v->time</td>
			<td>$v->unit</td>
		</tr>";
	}
}
?>
</table>
</div>
</body>
</html>