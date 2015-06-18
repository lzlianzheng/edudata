<?php
require_once 'include/common.inc.php';
if($_GET['act'] == 'sel')
{
$id = $_GET['id'];
$sql = "select * from stu_absent_record where id = '$id'";
$result = $yiqi_db->get_row($sql);
$yeardata = array('2011-2012','2012-2013','2013-2014','2014-2015','2015-2016','2016-2017','2017-2018','2018-2019','2019-2020','2020-2021');
}
$title="学生课堂记录修改";
include("header.php");
?>
<div class="menu tc">
<a href="kuangke_personal.php">返回</a>　
<h2 style="text-align:center;display:inline-block">学生课堂考勤记录</h2>
</div>
<form action="modify.php?act=kuangke_personal_save" method="post">
<input type="hidden" name="id" value="<?php echo $result->id; ?>" />
<table cellspacing="0" cellpadding="0" class="t_list list4">
<tr>
	<td class="w10">姓名</td>
	<td class="w40"><input type="text" name="name" value="<?php echo $result->name; ?>" /></td>
	<td class="w10">班级</td>
	<td class="w40"><input type="text" name="classname" value="<?php echo $result->classname; ?>" /></td>
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
	<td>旷课课时</td>
	<td><input type="text" name="kuangkekeshi" value="<?php echo $result->keshi; ?>" /></td>
</tr>
<tr>
	<td>旷课课程</td>
	<td><input type="text" name="coursename" value="<?php echo $result->coursename; ?>" /></td>
	<td>旷课日期</td>
	<td><input type="text" name="absentriqi" value="<?php echo $result->absentriqi; ?>" /></td>
</tr>
<tr>
	<td>迟到课时</td>
	<td><input type="text" name="chidaokeshi" value="<?php echo $result->chidaokeshi; ?>" /></td>
	<td>迟到课程</td>
	<td><input type="text" name="chidaocourse" value="<?php echo $result->chidaocourse; ?>" /></td>
</tr>
<tr>
	<td>迟到日期</td>
	<td><input type="text" name="chidaodate" value="<?php echo $result->chidaodate; ?>" /></td>
	<td>早退课时</td>
	<td><input type="text" name="zaotuikeshi" value="<?php echo $result->zaotuikeshi; ?>" /></td>
</tr>
<tr>
	<td>早退课程</td>
	<td><input type="text" name="zaotuicourse" value="<?php echo $result->zaotuicourse; ?>" /></td>
	<td>早退日期</td>
	<td><input type="text" name="zaotuidate" value="<?php echo $result->zaotuidate; ?>" /></td>
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
