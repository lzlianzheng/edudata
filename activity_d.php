<?php
require_once 'include/common.inc.php';
$title="活动参与修改";
include("header.php");
$id = $_REQUEST['id'];
$sql = "select * from activity_join where id = $id";
$data = $yiqi_db->get_row($sql);
?>
<script type="text/javascript" src="images/printarea.js"></script>
<div class="tc"><a href="activity.php?act=stat">返回列表</a><br/></div>
<form action="modify.php" method="post">
<input type="hidden" name="act" value="activity">
<input type="hidden" name="id" value="<?php echo $data->id;?>">
<table cellspacing="0" cellpadding="0" class="t_list list4">
<td>班级</td><td><input type="text" name="classname" value="<?php echo $data->class; ?>" /></td>
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
	<td>学年</td>
	<td><input type="text" name="year" value="<?php echo $data->year; ?>" /></td>
	<td>学期</td>
	<td><input type="text" name="xueqi" value="<?php echo $data->xueqi; ?>" /></td>
</tr>
<tr>
	<td>活动内容</td>
	<td><input type="text" name="content" value="<?php echo $data->content; ?>" /></td>
	<td>活动级别</td>
	<td><input type="text" name="grade" value="<?php echo $data->activity_grade; ?>" /></td>
</tr>
<tr>
	<td>活动时间</td>
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