<?php
require_once 'include/common.inc.php';
if($_REQUEST['act']=='stat')
{
$s_year=$_GET["s_year"];
$s_major=$_GET["s_major"];
$s_class = $_GET["s_class"];
$sql="select a.*,b.id from student_info a left join class b on a.classid=b.id where 1";
if($s_year)
	$sql .=" and b.year=$s_year";
if($s_major)
	$sql .=" and b.majorid=$s_major";
if($s_class)
	$sql .=" and a.classid=$s_class";
$result=$yiqi_db->get_results($sql);
}
$level=$yiqi_db->get_results('select grade from honour_type where id in(1,2,3,4)');
$sch_honour=$yiqi_db->get_results('select grade from honour_type where type="校级荣誉"');
$title="奖学金评定结果录入";
include("header.php");
?>
<script type="text/javascript">
function scholar_in(id){
	year = $("select[name=sch_year]").val();
	xueqi = $("select[name=sch_xueqi]").val();
	if(!year || !xueqi){
		alert("请输入奖励所属学年/学期");
	}else{
		$.get("./scholar_insert.php?act=save&year="+year+"&xueqi="+xueqi,$("#"+id).serialize(),function(data){
			alert(data);
		});
	}
	return false;
}
</script>

<div class="menu tc">
<a href="scholarship.php">返回</a>　　
<form action="scholar_result_insert.php" method="get" class="disin">
<input type="hidden" name="act" value="stat">
<?php
	require_once 's_year_class.php';
?>
　<input type="submit" value="查询" id="submit" />　　　　　
</form>
所属学年<select name='sch_year'><option value=''>请选择</option>";
<?php
foreach($yeardata as $k=>$v){
				echo "<option value='$v'>$v</option>";
}
?>
	</select>
学期<select name='sch_xueqi'><option value=''>请选择</option>";
	<option value="1">第一学期</option>
	<option value="2">第二学期</option>
	</select>
</div>

<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>学号</td>
	<td>姓名</td>
	<td>奖学金等级</td>
	<td>校级荣誉</td>
	<td>操作</td>
</tr>
<?php
if(count($result) > 0){
	foreach($result as $v){
		echo "<form  id='sl$v->sid' method='get' onsubmit='scholar_in(\"sl$v->sid\");return false;'><tr>
			<input type='hidden' name='act' value='save'>
			<td><input type='hidden' name='sid' value='$v->sid'/>$v->sid</td>
			<td><input type='hidden' name='name' value='$v->name'>$v->name</td>
			<td><select name='level'><option value=''>请选择</option>";
			
			foreach($level as $v)
			{
			echo "<option value='$v->grade'>$v->grade</option>";
			}
			echo "</select></td>";
			echo "<td>";
			foreach($sch_honour as $k=>$v){
			echo "$v->grade<input type='checkbox' name='sch[]' value='$v->grade'>";
			}
			echo "</td>";
			echo "<td>	
			<input type='submit' value='写入'/></td></tr></form>";
	}
	
}
?>
</table>
</div>
      	<?php include("footer.php");?>
</body>
</html>
