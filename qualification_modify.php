<?php
require_once 'include/common.inc.php';
$type=array('优秀','良好','中等','合格');
if($_GET['act'] == 'sel')
{
$id = $_GET['id'];
$sql = "select a.id as nid,a.*,b.name,b.sid,b.classid,c.id,c.majorid,c.name as classname,d.id,d.name as majorname from computer a left join student_info b on a.sid = b.sid left join class c on b.classid = c.id left join major d on d.id = c.majorid where a.id = '$id' ";
$result = $yiqi_db->get_row($sql);
}
$title="英语成绩修改";
include("header.php");
?>

<div class="menu tc">
<br><h2 style="text-align:center;display:inline-block">英语成绩修改</h2><br>
<a href="computer.php">返回</a>　
</div>
<form action="modify.php?act=computer" method="post">
<input type="hidden" name="nid" value="<?php echo $result->nid; ?>" />
<input type="hidden" name="stu_id" value="<?php echo $result->sid; ?>" />
<table cellspacing="0" cellpadding="0" class="t_list list4">
<tr>
	<td class="w10" align=center>学号</td><td align=center><?php echo $result->sid;?></td>
	<td class="w10" align=center>姓名</td><td align=center><?php echo $result->name; ?></td>
</tr>

<tr>
	<td class="w10" align=center>专业</td><td align=center><?php echo $result->majorname; ?></td>
	<td class="w10" align=center>班级</td><td align=center><?php echo $result->classname; ?></td>
</tr>
<tr>
	<td align=center >一级</td>
	<td align=center ><select name='first'><option value='无'>无</option>";
	<?php
	foreach($type as $v){
	$se = ($v == "$result->first")? " selected " : "";
	echo "<option $se value=$v>$v</option>";
	}
	?></select></td>
	<td align=center >二级</td>
	<td align=center ><select name="second"><option value="无">无</option>
	<?php
	foreach($type as $s){
	$se = ($s == "$result->second")? " selected " : "";
	echo "<option $se value='$s'>$s</option>";
	}
	?></select></td>
</tr>
<tr>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
<?php include("footer.php");?>
</body>
</html>
