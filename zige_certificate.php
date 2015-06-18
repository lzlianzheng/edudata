<?php
require_once 'include/common.inc.php';
$mid=$_GET["s_major"];
$class = $_GET["s_class"];
$syear = $_GET["syear"];
$eyear = $_GET["eyear"];
$scholar=$_GET["scholar"];

$sql="select a.*,b.id from zige_certificate a left join class b on a.classname=b.name where 1";
if($class){
$sql .=" and a.classname= '$class' ";
}

$sql2 = "select name from class where 1";
$sql2 .= ($syear)? " and year>='$syear' " : "";
$sql2 .= ($eyear)? " and year<='$eyear' " : "";
if($mid){
$sql .=" and majorid=$mid";
}
if($syear || $eyear)
$sql .= " and a.classname in ($sql2) ";
if($scholar){
$sql .=" and a.scholarship= '$scholar' ";
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
　

<form action="zige_certificate.php" method="get" class="disin">
<?php
	echo "专业 <select name='s_major'><option value=''>请选择</option>";
	$majorpara=globalpara("major");
	foreach($majorpara as $k=>$v){
		echo "<option value='$k'>$v</option>";
	}
	echo "</select>";
	echo "班级 <select name='s_class'><option value=''>请选择</option>";
	$classpara=globalpara("class");
	
	foreach($classpara as $k=>$x){
		echo "<option value='$x'>$x</option>";
		
	}
	echo "</select>";
?>
入学年 起<input type="text" name="syear" size=10 value="<?php echo $syear; ?>" />　止<input type="text" name="eyear" size=10 value="<?php echo $eyear; ?>" />
<input type="submit" value="查询" id="submit" />　　　　　
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>班级</td>
	<td>姓名</td>
	<td>学号</td>
	<td>英语三级A</td>
	<td>英语三级B</td>
	<td>英语四级</td>
	<td>英语六级</td>
	<td>计算机一级</td>
	<td>资格证书一</td>
	<td>资格证书二</td>
	<td>资格证书三</td>
	<td>资格证书四</td>
</tr>
<?php
if(count($result) > 0){
	foreach($result as $v){
		echo "<tr>
			<td>$v->classname</td>
			<td>$v->name</td>
			<td>$v->sid</td>
			<td>$v->engthirda</td>
			<td>$v->engthirdb</td>
			<td>$v->engforth</td>
			<td>$v->engsixth</td>
			<td>$v->computerfirst</td>
			<td>$v->certione</td>
			<td>$v->certitwo</td>
			<td>$v->certithree</td>
			<td>$v->certifour</td>
		</tr>";
	}
}
?>
</table>
</div>
</body>
</html>
