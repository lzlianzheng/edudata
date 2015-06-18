<?php
require_once 'include/common.inc.php';
$major=$_GET["s_major"];
$grade=$_GET["s_year"];
$classn = $_GET["s_class"];
$sxuenian = $_GET["xuenian"];
$sxueqi = $_GET["xueqi"];
$zhouci = $_GET["zhouci"];
if($_GET['act'] == 'sel')
{
$id = $_GET['id'];
$sql = "select * from weisheng_yuanji where id = '$id'";
$result = $yiqi_db->get_row($sql);
}
$title="院级卫生记录修改";
include("header.php");
?>
<div class="menu tc">
<h2 style="text-align:center;display:inline-block">公寓卫生-院级</h2><br/>
<a href="<?php echo "weisheng_score.php?act=stat&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi&zhouci=$zhouci"; ?>">返回</a>　
</div>
<form action="modify.php?act=weisheng_yuanji" method="post">
<input type="hidden" name="id" value="<?php echo $result->id; ?>" />
<table cellspacing="0" cellpadding="0" class="t_list list4">
<tr>
	<td class="w10">班级</td>
	<td class="w40"><input type="text" name="classname" value="<?php echo $result->class; ?>" /></td>
	<td class="w10"></td>
	<td class="w40"></td>
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
	<td>宿舍楼</td>
	<td><input type="text" name="dormlou" value="<?php echo $result->dormlou; ?>" /></td>
	<td>宿舍号</td>
	<td><input type="text" name="dormnum" value="<?php echo $result->dormnum; ?>" /></td>
</tr>
<tr>
	<td>周次</td>
	<td><input type="text" name="zhouci" value="<?php echo $result->zhouci; ?>" /></td>
	<td>得分</td>
	<td><input type="text" name="score" value="<?php echo $result->score; ?>" /></td>
</tr>
<tr>
	<td>记录日期</td>
	<td>
	<input type="text" name="checkdate" value="<?php echo $result->checkdate; ?>" />
	</td>
	<td>记录人</td>
	<td><input type="text" name="recorder" value="<?php echo $result->recorder; ?>" /></td>
</tr>
<tr>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
	<?php  include("footer.php");?>
</body>
</html>
