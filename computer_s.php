<?php
	require_once 'include/common.inc.php';
	require_once 'getuid.php';	
	$yeardata=array('2011-2012','2012-2013','2013-2014','2014-2015','2015-2016','2016-2017','2017-2018','2018-2019','2019-2020');
	$type=array('优秀','良好','合格');
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
	//		判断学期
	function CheckGrade($year)
	{
		if(date('Y')-$year<5&&date('Y')-$year>=0)
		{
			if(date('m')>9)
			{
				return $grade=((date('Y')-$year)+1)."年级";
			}
			else
			{
				$str=date('m');
				$str1=substr($str,2);
				if(date('m')>8)
				{
					return $grade=((date('Y')-$year)+1)."年级";
				}
				else
				{
					return $grade=(date('Y')-$year)."年级";
				}
			}
			
		}
	}
	$title="计算机考试等级录入";
	include("header.php");
	echo "<div class='nav'>
	<span class='fr'>
	</span>
	</div>";	
?>
<script type="text/javascript">
function scholar_in(id){
		$.get("./scholar_insert.php?act=computer",$("#"+id).serialize(),function(data){
			alert(data);
		});
	return false;
}
</script>

<div class="menu tc">
	<a href="computer.php">返回</a>　
	<form action="computer_s.php" method="get" class="disin">
	<input type="hidden" name="act" value="sel">
<?php
	require_once 's_year_class.php';
	require_once 's_name_sid.php';
?>　　
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>学号</td>
	<td>姓名</td>
	<td>班级</td>
	<td>一级</td>
	<td>二级</td>
	<td colspan="2">操作</td>
</tr>
<?php
	if($sql)
	{
		if(count($result) > 0)
		{
			foreach($result as $v)
			{
				echo "<form  id='sl$v->sid' method='get' onsubmit='scholar_in(\"sl$v->sid\");return false;'><tr>
					<td><input type='hidden' name='sid' value='$v->sid'/>$v->sid</td>
					<td><input type='hidden' name='name' value='$v->name'>$v->name</td>
					<td><input type='hidden' name='classname' value='$v->classname'/>$v->classname</td>
					<td><input type='text' name='first' value='' maxlength='20' size=5 /></td>
					<td><input type='text' name='second' value='' maxlength='20' size=5 /></td>
					<td><input type='submit' value='写入'/></td></tr></form>";
			}
		}		
		else{echo"<tr><td colspan='12'>暂无记录</td></tr>";}
	}	
	else{echo"<tr><td colspan='12'>请输入筛选条件</td></tr>";}
?>
</table>
      	<?php include("footer.php");?>
</body>
</html>
