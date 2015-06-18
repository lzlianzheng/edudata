<?php
require_once 'include/common.inc.php';
		$sname = $_GET["sname"];
		$sid = $_GET["sid"];
		$major=$_GET["s_major"];
		$grade=$_GET["s_year"];
		$classn = $_GET["s_class"];
		$sxuenian = $_GET["xuenian"];
		$sxueqi = $_GET["xueqi"];
		$zhouci = $_GET["zhouci"];
if($_GET['act'] == 'sel')
{
$id = $_GET['id'];
$sql = "select * from dormzhian where id = '$id'";
$result = $yiqi_db->get_row($sql);
}
$title="公寓考勤记录修改";
include("header.php");
?>
<div class="menu tc">
<h2 style="text-align:center;display:inline-block">学生公寓考勤记录</h2><br/>
<a href="<?php echo "dorm_zhian.php?act=list&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi&zhouci=$zhouci"; ?>">返回</a>
</div>
<form action="modify.php?act=dorm_zhian" method="post">
<input type="hidden" name="id" value="<?php echo $result->id; ?>" />
<table cellspacing="0" cellpadding="0" class="t_list list4">
<tr>
	<td align=center>姓名：</td><td align=center><?php echo $result->name; ?></td>
	<td align=center>班级：</td><td align=center><?php echo $result->class;?></td>
</tr>
<tr>
	<td>学年</td>
	<td>
		<select name="xuenian"><option value="0">请选择</option>
	<?php
	foreach($yeardata as $v){
	$se = ($v == "$result->year")? " selected " : "";
	echo "<option $se value=$v>$v</option>";
	}
	?>
		</select>
	</td>
	<td>学期</td>
	<td><input type="text" name="xueqi" value="<?php echo $result->xueqi; ?>" /></td>
</tr>
<tr>
	<td>周次</td>
	<td><input type="text" name="zhouci" value="<?php echo $result->zhouci; ?>" /></td>
	<td>违纪时间</td>
	<td><input type="text" name="time" value="<?php echo $result->time; ?>" /></td>
</tr>
<tr>
	<td>违纪情况</td>
	<td>
	<select name="weiji"><option value="0">请选择</option>
	<?php
	foreach($weijiarr as $v){
	$se = ($v == "$result->weiji")? " selected " : "";
	echo "<option $se value=$v>$v</option>";
	}
	?>
	</select>
	</td>
	<td>级别</td>
	<td><input type="text" name="jibie" value="<?php echo $result->jibie; ?>" /></td>
</tr>
<tr>
	<td>记录人</td>
	<td><input type="text" name="recorder" value="<?php echo $result->recorder; ?>" /></td>
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
