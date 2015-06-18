<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';
$sql="select * from major where uid=$uid";
$major=$yiqi_db->get_results($sql);

if($_REQUEST['act']=='save')
{
	$now = date("Y-m-d H:i:s");
	$cid= $_POST['cid'];
	$name=$_POST['name'];
	$mid=$_POST['zhuanye'];
	$year=$_POST['year'];
	$deanteacher=$_POST['deanteacher'];
	$monitor=$_POST['monitor'];
	$classroom=$_POST['classroom'];
	$capacity=$_POST['capacity'];
	$in="insert into class (id,name,year,majorid,classroom,capacity,deanteacher,monitor,edittime) values ($cid,'$name','$year','$mid','$classroom','$capacity','$deanteacher','$monitor','$now')";
	$a=$yiqi_db->query($in);
	if($a)
	{
	echo "<script type=text/javascript>alert('添加成功');location.href='class_insert.php';</script>";exit;
	}else
	{
	echo "<script type=text/javascript>alert('添加失败，请检查填写信息是否有误');window.history.go(-1);</script>";exit;
	}
}
$title="班级信息录入";	
include("header.php");
?>

<script type="text/javascript" src="images/printarea.js"></script>
 
<div class="tc">
<h2 class="disin">添加班级基本信息</h2>
<br><a href="class.php">返回   </a>
</div>
<form action="class_insert.php" method="post">
<input type="hidden" name="act" value="save" />
<table cellspacing="0" cellpadding="0" class="t_list list5">
<tr>
	<td class="w10">班级ID</td>
	<td class="w40"><input type="text" name="cid" /></td>
	<td class="w10">班级名称</td>
	<td class="w40"><input type="text" name="name"></td>
</tr>
<tr>
	<td>专业</td>
	<td>
	<select name="zhuanye">
	<option value="">请选择</option>
	<?php 
		foreach($major as $k=>$v)
		{
			echo "<option value='$v->id'>$v->name</option>";
		}
	?>
	</select>
	</td>
	<td>入学年</td>
	<td><input type="text" name="year"></td>
</tr>
<tr>
	<td>班主任</td>
	<td><input type="text" name="deanteacher"/></td>
	<td>班长</td>
	<td><input type="text" name="monitor" /></td>
</tr>
<tr>
	<td>教室</td>
	<td><input type="text" name="classroom" /></td>
	<td>容纳人数</td>
	<td><input type="text" name="capacity"/></td>
</tr>
<tr>
	<td colspan=4 align=center><input type="submit" value="　提  交　" /></td>
</tr>
</table>
</form>
      	<?php include("footer.php");?>
</body>
</html>
