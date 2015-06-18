<?php
require_once 'include/common.inc.php';
$title="志愿服务修改";
include("header.php");
$id = $_REQUEST['id'];
$sql = "select * from vol_service where id = $id";
$data = $yiqi_db->get_row($sql);
?>
<script type="text/javascript" src="images/printarea.js"></script>
<div class="tc"><a href="vol_service.php?act=sel">返回列表</a><br/></div>
<form action="modify.php" method="post">
<input type="hidden" name="act" value="service">
<input type="hidden" name="id" value="<?php echo $data->id;?>">
<table cellspacing="0" cellpadding="0" class="t_list list4">
<?php
	echo "<tr><td class='w10'>班级</td><td class='w40'><select name='s_class'><option value=''>请选择</option>";
	$classpara=globalpara("class");
	
	foreach($classpara as $k=>$x){
		$se = ($x==$data->class)? " selected " : "";
		echo "<option $se value='$x'>$x</option>";
	}
	echo "</select></td>";
?>
<td width="90"></td>
<td></td>
</tr>

<tr>
	<td>姓名</td>
	<td><input type="text" name="name" value="<?php echo $data->name; ?>" /></td>
	<td>学号</td>
	<td><input type="text" name="sid" value="<?php echo $data->sid; ?>" /></td>
</tr>
<tr>
	<td>学年</td>
	<td><input type="text" name="year" value="<?php echo $data->year; ?>" /></td>
	<td>学期</td>
	<td><input type="text" name="xueqi" value="<?php echo $data->xueqi; ?>" /></td>
</tr>
<tr>
	<td>服务内容</td>
	<td><input type="text" name="content" value="<?php echo $data->content; ?>" /></td>
	<td>优秀等级</td>
	<td><input type="text" name="grade" value="<?php echo $data->grade; ?>" /></td>
</tr>
<tr>
	<td>服务时间</td>
	<td><input type="text" name="time" value="<?php echo $data->time; ?>" /></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
<?php include("footer.php");?>
</body>
</html>