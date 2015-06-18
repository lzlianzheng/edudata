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
}else{
	$sql="select * from stuhonour ";
	}
$sql2="select c.*,d.id from stuhonour c join ($sql) d on c.sid=d.sid and c.jibie='校级'";
$level=$yiqi_db->get_results($sql2);
//print_r($level);
//$sch_honour=$yiqi_db->get_results('select grade from honour_type where type="校级荣誉"');
$title="校级荣誉修改";

include("header.php");
$action = $_POST["action"];
if($action == "delete")
{
    $idarr = $_POST["chk"];
	//print_r($idarr);
	if(count($idarr) > 0)
	{
	
		foreach($idarr as $id)
		{
			if(is_numeric($id))
			{
				$sql = "DELETE FROM stuhonour WHERE sid = '$id'";
				//$del="delete from scholarship where sid in($delete)";
				$a=$yiqi_db->query($sql);
				/* if($a)
					{
					$str .= "删除成功！";
					}
				 */
			}
		}
		ShowMsg("批量删除成功");
	}
}
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
function selectAll(){
 var checklist = document.getElementsByName ("chk[]");
   if(document.getElementById("stuNum").checked)
   {
   for(var i=0;i<checklist.length;i++)
   {
      checklist[i].checked = 1;
   } 
 }else{
  for(var j=0;j<checklist.length;j++)
  {
     checklist[j].checked = 0;
  }
 }
}
</script>

<div class="menu tc">
<a href="scholarship.php">返回</a>　　
<form action="scholar_honour.php" method="get" class="disin">
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
<form action="scholar_honour.php" method="post">
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>学号</td>
	<td>姓名</td>
	<td>校级荣誉</td>
	<td>操作</td>
	<td>批量删除</td>
</tr>
<?php 
if(count($result) > 0){
	foreach($level as $v){
		echo "<tr>
			<input type='hidden' name='act' value='save'>
			<td><span  name='sid' value='$v->sid'/>$v->sid</td>
			<td><span  name='name' value='$v->name'>$v->name</td>";
			
			echo "<td>";
			echo "<input type='hidden' name='scho' value='$v->honourname'>$v->honourname</td>";
			echo "</td>";
			
			echo "<td>	
			<a href='scholar_honour_d.php?sid=$v->sid'>修改</a>　
			<a href='scholar_del.php?act=scholar3_delect&sid=$v->sid'>删除</a></td>";
			echo "<td>";	
			
			echo "<input type='checkbox' name='chk[]' value='$v->sid'></td>";
	}
	
}
?>
</table>
<div style='float:right;'>
	<input type="checkbox"  onclick="selectAll();" id="stuNum"/>&nbsp;&nbsp;
	<select name="action">
	<option value="-">批量应用</option>
	<option value="delete">删除</option>
	</select>&nbsp;
	<input type="submit" class="subtn" value="提交" onclick="if(!confirm('确认执行相应操作?')) return false;"/>
</div>

</form>
      	<?php include("footer.php");?>
</body>
</html>
