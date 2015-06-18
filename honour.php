<?php
require_once 'include/common.inc.php';
$name = $_GET["stuname"];
$xueqi = $_GET["xueqi"];
$sql="select * from stuhonour where 1";
if($name)
{
$sql .= " and name= '$name'";
}
if($xueqi)
{
$sql .= " and xueqi=$xueqi";
}
echo $sql;
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
　

<form action="honour.php" method="get" class="disin">

请输入学生姓名：<input type="text" name="stuname" />
选择学期<select name='xueqi'><option value=''>请选择</option>";
	<option value="1">第一学期</option>
	<option value="2">第二学期</option>
	</select>
<input type="submit" value="查询" id="submit" />　　　　　
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>学年</td>
	<td>学期</td>
	<td>班级</td>
	<td>姓名</td>	
	<td>荣誉名称</td>
	<td>级别</td>
</tr>
<?php
if(count($result)>0){
echo count($result);
	foreach($result as $v){
	echo "<tr><td>$v->year</td>
			<td>$v->xueqi</td>
			<td>$v->class</td>
			<td>$v->name</td>
			<td>$v->honourname</td>
			<td>$v->jibie</td></tr>
			
	" ;
	}
	}
?>
</table>

</div>
</body>
</html>