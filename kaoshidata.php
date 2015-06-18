<?php
require_once 'include/common.inc.php';
$mid=$_GET["s_major"];
$class = $_GET["s_class"];
$syear = $_GET["syear"];
$eyear = $_GET["eyear"];
$xueqi = $_GET["xueqi"];
$sql="select a.*,b.id from xuefeng a left join class b on a.class=b.name where 1";
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
　

<form action="kaoshidata.php" method="get" class="disin">
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
	<td>学年</td>
	<td>学期</td>
	<td>奖学金获得率</td>
	<td>不及格率</td>
	<td>补考率</td>
</tr>
<?php
if(count($result) > 0){
$str="%";
	foreach($result as $v){
		echo "<tr>
			<td>$v->class</td>
			<td>$v->year</td>
			<td>$v->xueqi</td>
			<td>$v->scholarrate$str</td>
			<td>$v->bujige$str</td>
			<td>$v->bukao$str</td>
		</tr>";
	}
}
?>
</table>
</div>
</body>
</html>