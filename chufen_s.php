<?php
require_once 'include/common.inc.php';
if($_REQUEST['act']=='stat')
{
	$mid=$_GET["s_major"];
	$cid = $_GET["s_class"];
	$stuname = $_GET["stuname"];
	$sql="select a.sid,a.classid,a.name,b.id, b.name as classname from student_info a left join class b on a.classid=b.id where 1";
	$sql .= ($mid) ? " and b.majorid = '$mid' " : "";
	$sql .= ($cid) ? " and b.id = '$cid' " : "";
	$sql .= ($stuname) ? " and a.name = '$stuname' " : "";
	$result=$yiqi_db->get_results($sql);
}
$title="学生处分信息录入";
include("header.php");
?>
<script type="text/javascript">
function chufen_in(id){
		$.get("./scholar_insert.php?act=chufen_save",$("#"+id).serialize(),function(data){
			alert(data);
		});
	return false;
}
</script>
<div class="menu tc">
　
<a href="stu_chufen.php">返回</a>　
<form action="chufen_s.php" method="get" class="disin">
<input type="hidden" name="act" value="stat">
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
	<td>处分类型</td>
	<td>处分原因</td>
	<td>文件号</td>
	<td>处分时间</td>
	<td>操作</td>
</tr>
<?php
if(count($result) > 0){
	foreach($result as $v){
		echo "<form id='pl$v->sid' method='get' onsubmit='chufen_in(\"pl$v->sid\");return false;'><tr>
			<input type='hidden' name='classname' value='$v->classname'>
			<td><input type='hidden' name='sid' value='$v->sid'/>$v->sid</td>
			<td><input type='hidden' name='name' value='$v->name'/>$v->name</td>";
			echo "<td><input type='text' name='type' value='$v->type' size='15'/>$v->type</td>";
			echo "<td><input type='text' name='reason' value='$v->reason'/>$v->reason</td>
			<td><input type='text' name='wenjianhao' value='$v->wenjianhao' size='15'/>$v->wenjianhao</td>
			<td><input type='text' name='chufendata' value='$v->chufendata' size='15'/>$v->chufendata</td>
			";
			echo "<td>	
			<input type='submit' value='写入'/></td></tr></form>";
	}
	
}
?>
</table>
      	<?php include("footer.php");?>

</body>
</html>
