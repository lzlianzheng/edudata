<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';
$title="竞赛获奖信息录入";
include("header.php");
if($_REQUEST['act']=='stat')
{
		$sname = $_GET["sname"];
		$sid = $_GET["sid"];
		$major=$_GET["s_major"];
		$grade=$_GET["s_year"];
		$classn = $_GET["s_class"];
		$sql="select a.name,a.sid,a.classid,b.year,b.majorid,b.id,b.name as classname,c.id,c.uid from student_info a left join class b on a.classid=b.id left join major c on b.majorid = c.id where 1";
				$sql .=" and c.uid = $uid "; 
			if($sname)
				$sql .=" and b.name like '%$sname%' "; 
			if($sid)
				$sql .=" and a.sid=$sid";
			if($grade)
				$sql .=" and b.year=$grade";
			if($major)
				$sql .=" and b.majorid=$major";
			if($classn)
				$sql .=" and b.id=$classn";
		$result=$yiqi_db->get_results($sql);
}
?>
<script type="text/javascript">
	function scholar_in(id)
	{
		year = $("select[name=xuenian]").val();
		xueqi = $("select[name=xueqi]").val();
		if(!year || !xueqi)
		{
			alert("请输入活动参与所属学年/学期");
		}
		else
		{
			$.get("./bisai_insert.php?act=save&year="+year+"&xueqi="+xueqi,$("#"+id).serialize(),function(data)
			{
				alert(data);
			});
		}
		return false;
	}
</script>
<div class="menu tc">
　
<a href="bisai_prize.php">返回</a>　
<form action="bisai.php" method="get" class="disin">
<input type="hidden" name="act" value="stat">
<?php
	require_once 's_year_class.php';
	require_once 's_name_sid.php';
	require_once 's_xuenian(qi).php';
?>
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>学号</td>
	<td>姓名</td>
	<td>获奖类别</td>
	<td>获奖级别</td>
	<td>获奖名称</td>
	<td>名次</td>
	<td>获奖时间</td>
	<td>操作</td>
</tr>
<?php
$jibie=array('国家级','省级','市级','校级','院级','协会','其他');
$prizegrade=array('特等奖','一等奖','二等奖','三等奖','鼓励奖','军训优秀学员');
$leibie=array('体育活动类','文化艺术类','学科竞赛类');
	if($sql)
	{
if(count($result) > 0){
	foreach($result as $v){
		echo "<form id='pl$v->sid' method='get' onsubmit='scholar_in(\"pl$v->sid\");return false;'><tr>
			<input type='hidden' name='act' value='save'>
			<input type='hidden' name='classname' value='$v->classname'>
			<td><input type='hidden' name='sid' value='$v->sid'/>$v->sid</td>
			<td><input type='hidden' name='name' value='$v->name'>$v->name</td>
			<td><select name='leibie'><option value=''>请选择</option>";
			foreach($leibie as $v)
			{
			if($v==$leibie)
			echo "<option value='$v' selected>$v</option>";
			else
			echo "<option value='$v'>$v</option>";
			}
			echo "</select></td>
			<td><select name='jibie_re'><option value=''>请选择</option>";
			foreach($jibie as $v)
			{
			if($v==$jibie_re)
			echo "<option value='$v' selected>$v</option>";
			else
			echo "<option value='$v'>$v</option>";
			}
			echo "</select></td>";
			echo "<td>";
			echo "<input type='text' name='prizename' value='' maxlength='100'/>";
			echo "</td>
			<td><select name='prizegrade'><option value=''>请选择</option>";
			foreach($prizegrade as $v)
			{
			if($v==$prizegrade)
			echo "<option value='$v' selected>$v</option>";
			else
			echo "<option value='$v'>$v</option>";
			}
			echo "</select></td>
			<td><input type='text' name='prizedate' value='' maxlength='20'/></td>";
			echo "<td>	
			<input type='submit' value='写入'/></td></tr></form>";
	}
	
}		else{echo"<tr><td colspan='12'>暂无记录</td></tr>";}
	}	
	else{echo"<tr><td colspan='12'>请输入筛选条件</td></tr>";}
?>
</table>
      	<?php include("footer.php");?>
</body>
</html>
