<?php
require_once 'include/common.inc.php';
if($_GET['act'] == "sel" || $_GET["act"] == "out")
{
	$s_major=$_GET["s_major"];
	$s_class = $_GET["s_class"];
	$s_year = $_GET["s_year"];
	$xuenian=$_GET["xuenian"];
	$xueqi = $_GET["xueqi"];
	$sql="select a.id,a.content,a.time,a.grade,b.sid,b.name,c.name as classname from vol_service a left join student_info b on a.sid=b.sid left join class c on b.classid=c.id where 1";
	if($xueqi)
		$sql .= " and a.xueqi=$xueqi";
	if($xuenian)
		$sql .=" and a.year= '$xuenian'";
	if($s_year)
		$sql .=" and c.year= '$s_year'";
	if($s_major)
		$sql .=" and c.majorid= '$s_major'";
	if($s_class)
		$sql .=" and c.id= '$s_class'";
	$result=$yiqi_db->get_results($sql." order by c.id");
}
if($_GET["act"] == "out"){
	header("Content-type: application/vnd.ms-excel; charset=gb2312");
	Header("Content-Disposition: attachment; filename=services.xls");
	$tnow = "<td>班级</td><td>姓名</td><td>服务内容</td><td>服务时间</td><td>优秀等级</td>";
	echo "<table border=1><tr>".$tnow."</tr>\n";
	if(count($result) > 0){
		foreach($result as $v){
			$outc .= "<tr>
				<td>$v->classname</td>
				<td>$v->name</td>
				<td>$v->content</td>
				<td>$v->time</td>
				<td>$v->grade</td>
				</tr>";
		}
		echo $outc;
	}
		echo "</table>";
	}else{
$title="志愿服务";	 
include("header.php");
?>
<div class="menu tc">
<a href="data_in.php?name=vol_service">批量导入志愿服务</a>　　
<a href="service.php">普通录入</a>　　
<a href="<?php echo "vol_service.php?act=out&s_year=$s_year&s_major=$s_major&s_class=$s_class&xuenian=$xuenian&xueqi=$xueqi"; ?>">导出数据</a><br/>

<form action="vol_service.php" method="get" class="disin">
<input type="hidden" name="act" value="sel">
<?php
require_once 's_year_class.php';
?>
学年<select name="xuenian"><option value=''>全部</option>
<?php
foreach($yeardata as $v){
	$se = ($v == $xuenian)? " selected " : "";
	echo "<option $se value='$v'>$v</option>";
}
?>
  </select>
学期<select name='xueqi'><option value=''>请选择</option>";
	<option <?php if($xueqi =="1"){echo "selected";} ?> value="1">第一学期</option>
	<option <?php if($xueqi =="2"){echo "selected";} ?> value="2">第二学期</option>
	</select>
<input type="submit" value="查询" id="submit" />　　　　　
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>班级</td>
	<td>姓名</td>
	<td>服务内容</td>
	<td>服务时间</td>
	<td>优秀等级</td>
	<td colspan="2">操作</td>
</tr>
<?php
if(count($result) > 0){
	foreach($result as $v){
		echo "<tr>
			<td>$v->classname</td>
			<td>$v->name</td>
			<td>$v->content</td>
			<td>$v->time</td>
			<td>$v->grade</td>
			<td><a href='service_d.php?id=$v->id'>修改</a></td>
			<td><a href='scholar_del.php?act=service_del&id=$v->id&s_major=$s_major&s_class=$s_class&xuenian=$xuenian&xueqi=$xueqi'>删除</a></td>
		</tr>";
	}
}
?>
</table>
      	<?php include("footer.php");?>
</body>
</html>
<?php
}
?>
