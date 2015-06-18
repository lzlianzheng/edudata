<?php
require_once 'include/common.inc.php';
$type = array('发明专利','实用新型','外观设计','合作发明排名第一','合作发明排名第二','合作发明排名第三','合作新型排名第一','合作新型排名第二','合作新型排名第三','合作外观排名第一','合作外观排名第二','合作外观排名第三');
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
$sql = "select a.id as nid,a.*,b.name,b.sid,b.classid,c.id,c.majorid,c.name as classname,d.id,d.name as majorname from tech_invent a left join student_info b on a.sid = b.sid left join class c on b.classid = c.id left join major d on d.id = c.majorid where a.id = '$id' ";
$result = $yiqi_db->get_row($sql);
}

$title="科技发明信息修改";
include("header.php");
?>
<div class="menu tc">　
<h2 style="text-align:center;display:inline-block">科技发明信息修改</h2>
<br><a href="<?php echo "tech_invent.php?act=list&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi"; ?>">返回</a>
</div>
<form action="modify.php?act=tech_invent" method="post">
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
	<td align=center >发明类型</td><td align=center >
	<select name="type">
	<?php
	foreach($type as $v){
	$se = ($v == "$result->type")? " selected " : "";
	echo "<option $se value=$v>$v</option>";
	}
	?></select></td>
	<td align=center >发明内容</td>
	<td align=center ><input type="text" name="content" value="<?php echo $result->content; ?>" /></td>
</tr>
<tr>
	<td align=center >获得时间</td>
	<td align=center ><input type="text" name="time" value="<?php echo $result->time; ?>" /></td>
	<td align=center >授予单位</td>
	<td align=center ><input type="text" name="danwei" value="<?php echo $result->danwei; ?>" /></td>
</tr>
<tr>
	<td align=center >学年</td>
	<td align=center >
		<select name="xuenian">
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
<tr>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
<?php include("footer.php");?>
</body>
</html>
