<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	
if($_REQUEST['act']=='sel')
{
		$sname = $_GET["sname"];
		$sid = $_GET["sid"];
		$major=$_GET["s_major"];
		$grade=$_GET["s_year"];
		$classn = $_GET["s_class"];
		$sql="select a.name,a.sid,a.classid,b.year,b.majorid,b.id,b.name as classname,c.id,c.uid from student_info a left join class b on a.classid=b.id left join major c on b.majorid = c.id where 1";
				$sql .=" and c.uid = $uid "; 
			if($sname)
				$sql .=" and a.name like '%$sname%' "; 
			if($sid)
				$sql .=" and a.sid=$sid";
			if($grade)
				$sql .=" and b.year=$grade";
			if($major)
				$sql .=" and b.majorid=$major";
			if($classn)
				$sql .=" and b.id=$classn";
			//print("$sql");
		$result=$yiqi_db->get_results($sql);
	}
$title="旷课信息录入";
include("header.php");
?>
<script type="text/javascript">
function scholar_in(id){
	year = $("select[name=xuenian]").val();
	xueqi = $("select[name=xueqi]").val();
	if(!year || !xueqi){
		alert("请输入学生旷课所属学年/学期");
	}else{
		$.get("./scholar_insert.php?act=kuangke_personal&year="+year+"&xueqi="+xueqi,$("#"+id).serialize(),function(data){
			alert(data);
		});
	}
	return false;
}
</script>
      
<div class="menu tc">
　
<a href="kuangke_personal.php">返回</a>　
<form action="kuangke_personal_s.php" method="get" class="disin">
<input type="hidden" name="act" value="sel">
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
	<td>周次</td>
	<td>旷课课时</td>
	<td>旷课课程</td>
	<td>旷课日期</td>
	<!--td>迟到课时</td>
	<td>迟到课程</td>
	<td>迟到日期</td>
	<td>早退课时</td>
	<td>早退课程</td>
	<td>早退日期</td-->
	<td>记录人</td>
	<td>操作</td>
</tr>
<?php
if($sql)
{
if(count($result) > 0){
	foreach($result as $v){
		echo "<form  id='sl$v->sid' method='get' onsubmit='scholar_in(\"sl$v->sid\");return false;'><tr>
			<input type='hidden' name='classname' value='$v->classname'/>
			<td><input type='hidden' name='sid' value='$v->sid'/>$v->sid</td>
			<td><input type='hidden' name='name' value='$v->name'>$v->name</td>
			<td><input type='text' name='zhouci' value='' size=3 /></td>
			<td><input type='text' name='kuangkekeshi' value='' size=3 /></td>
			<td><input type='text' name='coursename' value='' size=8 /></td>
			<td><input type='text' name='absentriqi' value='' size=8 /></td>
			<!--td><input type='text' name='chidaokeshi' value='' size=3 /></td>
			<td><input type='text' name='chidaocourse' value='' size=8 /></td>
			<td><input type='text' name='chidaodate' value='' size=8 /></td>
			<td><input type='text' name='zaotuikeshi' value='' size=3 /></td>
			<td><input type='text' name='zaotuicourse' value='' size=8 /></td>
			<td><input type='text' name='zaotuidate' value='' size=8 /></td-->
			<td><input type='text' name='recorder' value='' size=6 /></td>
			<td><input type='submit' value='写入'/></td></tr></form>";
	}
	
}
		else
		{
			echo "<tr><td colspan='12'>暂无记录</td></tr>";
		}
}
		else
		{
			echo "<tr><td colspan='12'>请输入筛选条件</td></tr>";
		}
?>
</table>
      	<?php include("footer.php");?>
</body>
</html>
