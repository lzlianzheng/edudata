<?php
require_once 'include/common.inc.php';
if($_REQUEST['act']=='stat')
{
	$mid=$_GET["s_major"];
	$cid = $_GET["s_class"];
	$year = $_GET["syear"];
	$xueqi = $_GET["xueqi"];
	$sql="select a.*,b.id, b.name as classname from student_info a left join class b on a.classid=b.id where 1";
	if($mid)
	{
	$sql .=" and majorid=$mid";
	}
	if($cid)
	{
	$sql .=" and classid=$cid";
	}
	$result=$yiqi_db->get_results($sql);
}
$title="社会实践录入";
include("header.php");
?>
<script type="text/javascript">
$(document).ready(function(){
	$("select[name=s_major]").change(function(){
		$.get("jsondata.php?type=class&mid="+$(this).val(),null,function(data){
			$("select[name=s_class]").html(data);
		});
	});
});
function practice_in(id){
	year = $("input[name=year]").val();
	xueqi = $("select[name=xueqi]").val();
	if(!year || !xueqi){
		alert("请输入奖励所属学年/学期");
	}else{
		$.get("./practice_insert.php?act=save&year="+year+"&xueqi="+xueqi,$("#"+id).serialize(),function(data){
			alert(data);
		});
	}
	return false;
}
</script>
      
<div class="menu tc">
　
<a href="socialprac.php">返回</a>　
<form action="practice.php" method="get" class="disin">
<input type="hidden" name="act" value="stat">
<?php
	echo "专业 <select name='s_major'><option value=''>请选择</option>";
	$majorpara=globalpara("major");
	foreach($majorpara as $k=>$v){
		if($cid==$k)
		echo "<option value='$k' selected>$v</option>";
		else
		echo "<option value='$k'>$v</option>";
	}
	echo "</select>";
	echo "班级 <select name='s_class'><option value=''>请选择</option>";
	$classpara=globalpara("class");
	
	foreach($classpara as $k=>$x){
		echo "<option value='$k'>$x</option>";
	}
	echo "</select>";
?>
<input type="submit" value="查询" id="submit" />　　　　　
</form>
所属学年<input type="text" name="year" size=10 value="<?php echo $syear; ?>" />　
学期<select name='xueqi'><option value=''>请选择</option>";
	<option value="1">第一学期</option>
	<option value="2">第二学期</option>
	</select>
</div>

<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>学号</td>
	<td>姓名</td>
	<td>等级</td>
	<td>先进个人等级</td>
	<td>操作</td>
</tr>
<?php
$jibie=array('国家级','省级','市级','校级','院级','协会','其他');
$dengji=array('合格','优秀');
if(count($result) > 0){
	foreach($result as $v){
		echo "<form id='pl$v->sid' method='get' onsubmit='practice_in(\"pl$v->sid\");return false;'><tr>
			<input type='hidden' name='act' value='save'>
			<input type='hidden' name='classname' value='$v->classname'>
			<td><input type='hidden' name='sid' value='$v->sid'/>$v->sid</td>
			<td><input type='hidden' name='name' value='$v->name'/>$v->name</td>";
			echo "<td><select name='grade'><option value=''>请选择</option>";
			foreach($dengji as $v)
			{
			if($v==$grade)
			echo "<option value='$v' selected>$v</option>";
			else 
			echo "<option value='$v'>$v</option>";
			}
			echo "</select></td>";
			echo "<td><select name='jibie_re'><option value=''>请选择</option>";
			foreach($jibie as $v)
			{
			if($v==$jibie_re)
			echo "<option value='$v' selected>$v</option>";
			else
			echo "<option value='$v'>$v</option>";
			}
			echo "</select></td>";
			echo "<td>	
			<input type='submit' value='写入'/></td></tr></form>";
	}
	
}
?>
</table>
      	<?php include("footer.php");?>

</body>
</html>
