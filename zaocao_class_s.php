<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	
if($_REQUEST['act'] == 'zaocao_class_sel')
{
		$major=$_GET["s_major"];
		$grade=$_GET["s_year"];
		$classn = $_GET["s_class"];
		$sql="select a.*,b.id,b.uid from class a left join major b on a.majorid = b.id where 1";
				$sql .=" and b.uid = $uid "; 
			if($grade)
				$sql .=" and a.year=$grade";
			if($major)
				$sql .=" and a.majorid=$major";
			if($classn)
				$sql .=" and a.id=$classn";
		$result=$yiqi_db->get_results($sql);
}
$title="班级早操信息录入";
include("header.php");
?>
<script type="text/javascript">
function scholar_in(id){
	year = $("select[name=xuenian]").val();
	xueqi = $("select[name=xueqi]").val();
	if(!year || !xueqi){
		alert("请输入班级早操得分记录所属学年/学期");
	}else{
		$.get("./scholar_insert.php?act=zaocao_class&year="+year+"&xueqi="+xueqi,$("#"+id).serialize(),function(data){
			alert(data);
		});
	}
	return false;
}
</script>
<div class="menu tc">
　
<a href="zaocao_class_score.php">返回</a>　
<form action="zaocao_class_s.php" method="get" class="disin">
<input type="hidden" name="act" value="zaocao_class_sel">
<?php
	require_once 's_year_class.php';
	require_once 's_xuenian(qi).php';
?>

</form>
</div>

<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>班级</td>
	<td>周次</td>	
	<td>质量分</td>
	<td>记录人</td>	
	<td>操作</td>
</tr>
<?php
if($sql)
{
	if(count($result) > 0){
		foreach($result as $v){
			echo "<form  id='sl$v->cid' method='get' onsubmit='scholar_in(\"sl$v->cid\");return false;'><tr>
				<input type='hidden' name='cid' value='$v->id'/>
				<td><input type='hidden' name='classname' value='$v->name' size=15 />$v->name</td>
				<td><input type='text' name='zhouci' value='' size=5 /></td>
				<td><input type='text' name='score' value=''/ size=15 /></td>
				<td><input type='text' name='recorder' value='' size=15 /></td>
				<td><input type='submit' value='写入'/></td></tr></form>";
		}
		
	}
		else
		{
			echo "<tr><td colspan='12'>暂无记录</td></tr>";
		}
}
?>
</table>
      	<?php include("footer.php");?>
</body>
</html>
