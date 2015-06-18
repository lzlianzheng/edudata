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
$title="公寓治安信息录入";
include("header.php");
?>
<script type="text/javascript">
function scholar_in(id){
	year = $("select[name=xuenian]").val();
	xueqi = $("select[name=xueqi]").val();
	if(!year || !xueqi){
		alert("请输入公寓考勤所属学年/学期");
	}else{
		$.get("./scholar_insert.php?act=dorm_zhian_save&year="+year+"&xueqi="+xueqi,$("#"+id).serialize(),function(data){
			alert(data);
		});
	}
	return false;
}
</script>
<div class="menu tc">
　
<a href="dorm_zhian.php">返回</a>　
<form action="dorm_zhian_s.php" method="get" class="disin">
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
	<td>班级</td>
	<td>周次</td>
	<td>违纪时间</td>
	<td>违纪情况</td>
	<td>级别</td>
	<td>记录人</td>
	<td>操作</td>
</tr>
<?php
if($sql){
if(count($result) > 0){
	foreach($result as $v){
		echo "<form  id='sl$v->sid' method='get' onsubmit='scholar_in(\"sl$v->sid\");return false;'><tr>
			<input type='hidden' name='classname' value='$v->classname'/>
			<td><input type='hidden' name='sid' value='$v->sid'/>$v->sid</td>
			<td><input type='hidden' name='name' value='$v->name'>$v->name</td>
			<td>$v->classname</td>
			<td><input type='text' name='zhouci' value='' size=5 /></td>
			<td><input type='text' name='time' value='' size=15 /></td>
			<td>
				<select name='weiji' >
				<option value='请选择'>请选择</option>
				<option value='夜不归宿一次'>夜不归宿一次</option>
				<option value='晚归'>晚归</option>
				<option value='抽烟'>抽烟</option>
				<option value='烟头/打火机'>烟头/打火机</option>
				<option vaiue='违章电器'>违章电器</option>
				<option vaiue='无理取闹'>无理取闹</option>
				</select>
			</td>
			<td>
				<select name='jibie'>
				<option value='请选择'>请选择</option>
				<option value='校级'>校级</option>
				<option value='院级'>院级</option>
				</select>
			</td>
			<td><input type='text' name='recorder' value='' size=15 /></td>
			<td><input type='submit' value='写入'/></td></tr></form>";
	}		
	}else{echo"<tr><td colspan='12'>暂无记录</td></tr>";}
	}else{echo"<tr><td colspan='12'>请输入筛选条件</td></tr>";}
?>
</table>
      	<?php include("footer.php");?>
</body>
</html>