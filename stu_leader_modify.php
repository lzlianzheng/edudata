<?php
require_once 'include/common.inc.php';
$jibiedata=array('校级','院级','班级');
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
$sql = "select a.id as nid,a.*,b.name,b.sid,b.classid,c.id,c.majorid,c.name as classname,d.id,d.name as majorname from stu_leader a left join student_info b on a.sid = b.sid left join class c on b.classid = c.id left join major d on d.id = c.majorid where a.id = '$id' ";
$result = $yiqi_db->get_row($sql);
$org1 = $yiqi_db->get_results("select * from org_style ");	
$org2 = $yiqi_db->get_results("select * from org_style_d where cid = $result->org_class");
}
$title="干部任职修改";
include("header.php");
?>
<script type="text/javascript">
$(document).ready(function(){
$("select[name=org_class]").change(function(){
	//alert($(this).val());//调试的时候用，this代指'select';
		$.get("jsondata.php?type=org&org_class="+$(this).val(),null,function(data){
			$("select[name=org_zhiwu]").html(data);
		});
	});
});
</script>
<div class="menu tc">
<h2 style="text-align:center;display:inline-block">干部任职修改</h2>
<br><a href="<?php echo "stu_leader.php?act=list&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi"; ?>">返回</a>
</div>
<form action="modify.php?act=stu_leader" method="post">
<input type="hidden" name="nid" value="<?php echo $result->nid; ?>" />
<table cellspacing="0" cellpadding="0" class="t_list list4">
<tr>
	<td class="w10">学号：</td><td><?php echo $result->sid;?></td>
	<td class="w10">姓名</td><td><?php echo $result->name; ?></td>
</tr>

<tr>
	<td class="w10">专业</td><td><?php echo $result->majorname; ?></td>
	<td class="w10">班级</td><td><?php echo $result->classname; ?></td></tr>
	<td>学年</td><td><select name="xuenian">
	<?php
	foreach($yeardata as $v){
	$se = ($v == "$result->year")? " selected " : "";
	echo "<option $se value=$v>$v</option>";
	}
	?></select></td>
	<td>学期</td><td><select name='xueqi'>
	<option <?php if($result->xueqi==1){echo "selected";} ?> value="1">第一学期</option>
	<option <?php if($result->xueqi==2){echo "selected";} ?> value="2">第二学期</option></td>
	</select>
</tr>

<tr>
	<td>组织类别</td><td><select name="org_class" >
	<?php
	foreach($org1 as $s)
		{
				  $se = ($s->id ==$result->org_class)? " selected " : "";
			echo "<option $se value='$s->id'>$s->class</option>";
		}
	?>
	</select></td>
	<td>级别</td><td><select name="org_jibie">
	<?php
	foreach($jibiedata as $v)
    {
	  $se = ($v==$result->org_grade)? " selected " : "";
	echo "<option $se value='$v'>$v</option>";}
	?>
    </td>
</tr>
<tr>
	<td>职务</td><td><select name="org_zhiwu" >
	<?php
	foreach($org2 as $s)
		{
				  $se = ($s->id == $result->zhiwu)? " selected " : "";
			echo "<option $se value='$s->id'>$s->name</option>";
		}
	?>
	</select></td>
	<td>qq</td>
	<td><input type="text" name="qq" value="<?php echo $result->qq; ?>" /></td>
</tr>
<tr>
	<td>聘任时间</td>
	<td><input type="text" name="emp_time" value="<?php echo $result->emp_time; ?>" /></td>
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
