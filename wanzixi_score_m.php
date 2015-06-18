<?php
require_once 'include/common.inc.php';
if($_GET['act'] == 'sel')
{
$id = $_GET['id'];
$major=$_GET["s_major"];
$grade=$_GET["s_year"];
$classn = $_GET["s_class"];
$sxuenian = $_GET["xuenian"];
$sxueqi = $_GET["xueqi"];
$zhouci = $_GET["zhouci"];
$sql = "select * from wanzixi_class where id = '$id'";
$result = $yiqi_db->get_row($sql);
}
$title="班级晚自习记录修改";
include("header.php");
?>

<div class="menu tc">
<h2 style="text-align:center;display:inline-block">班级晚自习考核周记录</h2>
<br><a href="<?php echo "wanzixi_class_score.php?act=wanzixi_score&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi&zhouci=$zhouci"; ?>">返回</a>　
</div>
<form action="modify.php?act=wanzixi_class_save" method="post">
<input type="hidden" name="id" value="<?php echo $result->id; ?>" />
<table cellspacing="0" cellpadding="0" class="t_list list4">
<tr>
<tr><td>班级：</td><td><?php echo $result->class;?></td>
	<td>记录人</td>
	<td><input type="text" name="recorder" value="<?php echo $result->recorder; ?>" /></td>
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
	<td>学期：</td><td><select name='xueqi'>
	<option <?php if($result->xueqi==1){echo "selected";} ?> value="1">第一学期</option>
	<option <?php if($result->xueqi==2){echo "selected";} ?> value="2">第二学期</option>
	</td></tr>
	</select>
</tr>
<tr>
	<td>周次</td>
	<td><input type="text" name="zhouci" value="<?php echo $result->zhouci; ?>" /></td>
	<td>分数</td>
	<td><input type="text" name="score" value="<?php echo $result->score; ?>" /></td>
</tr>
<tr>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
<?php include("footer.php");?>
</body>
</html>
