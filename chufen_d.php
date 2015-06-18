<?php
require_once 'include/common.inc.php';

$id = $_REQUEST['id'];
$sql = "select * from stu_chufen where id = $id";
$data = $yiqi_db->get_row($sql);
$title="学生处分信息修改";
include("header.php");
?>
<script type="text/javascript" src="images/printarea.js"></script>
<div class="tc"><a href="stu_chufen.php">返回列表</a><br/></div>
<form action="modify.php" method="post">
<input type="hidden" name="act" value="chufen">
<input type="hidden" name="id" value="<?php echo $data->id;?>">
<table cellspacing="0" cellpadding="0" class="t_list list4">
<td>班级</td><td><input type="text" name="classname" value="<?php echo $data->classname; ?>" /></td>
<td></td>
<td></td>
</tr>

<tr>
	<td>姓名</td>
	<td><input type="text" name="name" value="<?php echo $data->name; ?>" /></td>
	<td>学号</td>
	<td><input type="text" name="sid" value="<?php echo $data->sid; ?>" /></td>
</tr>
<tr>
	<td>处分类型</td>
	<td><input type="text" name="type" value="<?php echo $data->type; ?>" /></td>
	<td>处分原因</td>
	<td><input type="text" name="reason" value="<?php echo $data->reason; ?>" /></td>
</tr>
<tr>
	<td>文件号</td>
	<td><input type="text" name="wenjianhao" value="<?php echo $data->wenjianhao; ?>" /></td>
	<td>处分时间</td>
	<td><input type="text" name="chufendata" value="<?php echo $data->chufendata; ?>" /></td>
</tr>
<tr>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
<?php include("footer.php");?>
</body>
</html>