<?php
require_once 'include/common.inc.php';
$jibie=array('特等奖学金','一等奖学金','二等奖学金','三等奖学金');
$sname = $_GET["sname"];
$sid = $_GET["sid"];
$major=$_GET["s_major"];
$grade=$_GET["s_year"];
$classn = $_GET["s_class"];
$sxuenian = $_GET["xuenian"];
$sxueqi = $_GET["xueqi"];
if($_GET['act'] == 'sel')
{
$id = $_GET['id'];
$sql = "select a.id as nid,a.*,b.name,b.sid,b.classid,c.id,c.majorid,c.name as classname,d.id,d.name as majorname from scholarship a left join student_info b on a.sid = b.sid left join class c on b.classid = c.id left join major d on d.id = c.majorid where a.id = '$id' ";
$result = $yiqi_db->get_row($sql);
}
$title="奖学金信息修改";
include("header.php");
?>

<div class="menu tc">
<br><h2 style="text-align:center;display:inline-block">奖学金信息修改</h2><br>
<a href="<?php echo "scholarship.php?act=list&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi"; ?>">返回</a>　
</div>
<form action="modify.php?act=scholarship" method="post">
<input type="hidden" name="nid" value="<?php echo $result->nid; ?>" />
<input type="hidden" name="stu_id" value="<?php echo $result->sid; ?>" />
<table cellspacing="0" cellpadding="0" class="t_list list4">
<tr>
	<td class="w10" align=center>学号</td><td align=center><?php echo $result->sid;?></td>
	<td class="w10" align=center>姓名</td><td align=center><?php echo $result->name; ?></td>
</tr>

<tr>
	<td class="w10" align=center>专业</td><td align=center><?php echo $result->majorname; ?></td>
	<td class="w10" align=center>班级</td><td align=center><?php echo $result->classname; ?></td></tr>
	<td align=center >学年</td><td align=center ><select name="xuenian">
	<?php
	foreach($yeardata as $v){
	$se = ($v == "$result->year")? " selected " : "";
	echo "<option $se value=$v>$v</option>";
	}
	?></select></td>
	<td align=center>学期</td><td align=center><select name='xueqi'>
	<option <?php if($result->xueqi==1){echo "selected";} ?> value="1">第一学期</option>
	<option <?php if($result->xueqi==2){echo "selected";} ?> value="2">第二学期</option></td>
	</select>
</tr>

<tr>
	<td align=center >奖学金等级</td><td align=center ><select name="scholarship">
	<?php
	foreach($jibie as $v){
	$se = ($v == "$result->scholarship")? " selected " : "";
	echo "<option $se value=$v>$v</option>";
	}
	?></select></td>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
<?php include("footer.php");?>
</body>
</html>
