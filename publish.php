<?php
require_once 'include/common.inc.php';
if($_REQUEST['act']=='stat')
{
$mid=$_GET["s_major"];
$cid = $_GET["s_class"];
$year = $_GET["syear"];
$sql="select a.*,b.id,b.name as classname from student_info a left join class b on a.classid=b.id where 1";
if($mid)
{
$sql .=" and majorid=$mid";
}
if($cid)
{
$sql .=" and classid=$cid";
}
if($year)
{
$sql .=" and b.year=$year";
}
$result=$yiqi_db->get_results($sql);
}
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
		$.get("jsondata.php?type=class&mid="+$(this).val(),null,function(data){
			$("select[name=s_class]").html(data);
		});
	});
});
</script>
<body>
<div class="mainbody">
<div class="menu tc">
　

<form action="publish.php" method="get" class="disin">
<input type="hidden" name="act" value="stat">
<?php
	echo "专业 <select name='s_major'><option value=''>请选择</option>";
	$majorpara=globalpara("major");
	foreach($majorpara as $k=>$v){
		if($cid==$k)
		echo "<option value='$k' selected>$v</option>";
		else
		echo "<option value='$k'>$v</option>";
	}
	echo "</select>";
	echo "班级 <select name='s_class'><option value=''>请选择</option>";
	$classpara=globalpara("class");
	
	foreach($classpara as $k=>$x){
		echo "<option value='$k'>$x</option>";
		
	}
	echo "</select>";
?>
入学年<input type="text" name="syear" size=10 value="<?php echo $syear; ?>" />　
<input type="submit" value="查询" id="submit" />　　　　　
</form>
</div>

<table cellspacing="0" cellpadding="0" class="t_list tc list6">
<tr>
	<td>学号</td>
	<td>姓名</td>
	<td>班级</td>
	<td>文章名称</td>
	<td>发表时间</td>
	<td>刊物名称</td>
	<td>刊物级别</td>
	<td>稿酬</td>
	<td>操作</td>
</tr>
<?php
if(count($result) > 0){
	foreach($result as $v){
		echo "<form action='publish_insert.php' id='$v->sid'><tr>
			<input type='hidden' name='act' value='xieru'>
			<td><input type='hidden' name='sid' value='$v->sid'/>$v->sid</td>
			<td><input type='hidden' name='name' value='$v->name'>$v->name</td>
			<td><input type='hidden' name='classname' value='$v->classname'>$v->classname</td>
			<td><input type='text' name='articlename' value='' maxlength='100'/></td>
			<td><input type='text' name='publishdate' value='' maxlength='20'/></td>
			<td><input type='text' name='kanwuname' value='' maxlength='100'/></td>
			<td><input type='text' name='kanwujibie' value='' maxlength='10'/></td>
			<td><input type='text' name='gaochou' value='' /></td>
			<td><input type='submit' value='写入'/></td></tr></form>";
	}
	
}
?>
</table>
</div>
</body>
</html>
