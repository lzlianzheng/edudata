<?php
require_once 'include/common.inc.php';
$sname = $_GET["sname"];
$sid = $_GET["sid"];
$major=$_GET["s_major"];
$grade=$_GET["s_year"];
$classn = $_GET["s_class"];
$sxuenian = $_GET["xuenian"];
$sxueqi = $_GET["xueqi"];
$xingwei=array('考试作弊','闹事','赌博','酗酒','打架','破坏公共设施','损害学校和他人财产','非法传销','进行邪教封建迷信活动');
if($_GET['act'] == 'sel')
{
$id = $_GET['id'];
$sql = "select a.id as nid,a.*,b.name,b.sid,b.classid,c.id,c.majorid,c.name as classname,d.id,d.name as majorname from buwenming a left join student_info b on a.sid = b.sid left join class c on b.classid = c.id left join major d on d.id = c.majorid where a.id = '$id' ";
$result = $yiqi_db->get_row($sql);
}
$title="其他不文明行为修改";
include("header.php");
?>

<div class="menu tc">
<br><h2 style="text-align:center;display:inline-block">其他不文明行为修改</h2><br>
<a href="<?php echo "buwenming.php?act=list&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi"; ?>">返回</a>　
</div>
<form action="modify.php?act=buwenming" method="post">
<input type="hidden" name="nid" value="<?php echo $result->nid; ?>" />
<input type="hidden" name="sid" value="<?php echo $result->sid; ?>" />
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
	$se = ($v == "$result->xuenian")? " selected " : "";
	echo "<option $se value=$v>$v</option>";
	}
	?></select></td>
	<td align=center>学期</td><td align=center><select name='xueqi'>
	<option <?php if($result->xueqi==1){echo "selected";} ?> value="1">第一学期</option>
	<option <?php if($result->xueqi==2){echo "selected";} ?> value="2">第二学期</option></td>
	</select>
</tr>

<tr>
	<td align=center>周次</td><td align=center><input  name='zhouci' value="<?php echo $result->zhouci; ?>"></td>
	<td align=center>时间</td><td align=center><input  name='time' value="<?php echo $result->time; ?>"></td>
</tr>

<tr>
	<td align=center>不文明行为</td><td align=center><select name='content'><option>请选择</option>
				<?php	foreach($xingwei as $s)
					{
						$se = ($s == "$result->content")? " selected " : "";
						echo "<option $se value=$s>$s</option>";
					}?>
					</select></td>
	<td align=center>记录人</td><td align=center><input  name='recorder' value="<?php echo $result->recorder; ?>"></td>
</tr>
<tr>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
<?php include("footer.php");?>
</body>
</html>
