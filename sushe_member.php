<?php
require_once 'include/common.inc.php';
$sql = "select distinct(dormbn) from student_info";
$dormdata = $yiqi_db->get_results($sql);

if($_GET["act"] == "display" || $_GET["act"] == "out")
{
	$syear = $_REQUEST['syear'];
	$dormlou = $_REQUEST['dormlou'];
	$dormnum = $_REQUEST['number'];
	$sql2 = "select a.classid,a.name,a.mobilephone,b.name as classname from student_info a left join class b on a.classid = b.id where 1";
	if($dormlou)
	$sql2 .= " and a.dormbn = '$dormlou'";
	if($dormnum)
	$sql2 .= " and a.dormnumber = '$dormnum'";
	$sql2 .= ($syear)? " and b.year = '$syear' " : "";
	$data=$yiqi_db->get_results($sql2);
}
if($_GET["act"] == "out")
{
	header("Content-type: application/vnd.ms-excel; charset=gb2312");
	Header("Content-Disposition: attachment; filename=sushe_member.xls");
	$tnow = "<td>班级</td><td>姓名</td><td>电话</td>";
	echo "<table border=1><tr>".$tnow."</tr>\n";
	if(count($data)>0){
		foreach($data as $k=>$v)
		{
		$outc .= "<tr><td>$v->classname</td><td>$v->name</td><td>$v->mobilephone</td></tr>";
		}
		echo $outc;
	}
	echo "</table>";
}else{
$title="宿舍成员";
include("header.php");
?>
       
<div class="menu tc">

<a href="<?php echo "sushe_member.php?act=out&syear=$syear&dormlou=$dormlou&number=$dormnum"; ?>">导出数据</a><br/>	
<form action="sushe_member.php" method="get" class="disin">
	<input type="hidden" name="act" value="display">
请输入入学年：<input type="text" name="syear" size=10 value="<?php echo $syear; ?>" />
  楼号<select name="dormlou">
	<option value=''>请选择</option>
	 <?php
		foreach($dormdata as $k=>$v)
		{
			if($v->dormbn)
			{
				if($v->dormbn == $dormlou)
				echo "<option value='$v->dormbn' selected>$v->dormbn</option>";
				else
				echo "<option value='$v->dormbn'>$v->dormbn</option>";
		    }
		}
	 ?>
  </select>
  宿舍号<input type="text" name="number" size=10 value="<?php echo $dormnum?>">
<input type="submit" value="查询" id="submit" />　　　　　
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>班级</td>
	<td>姓名</td>
	<td>电话</td>
</tr>
<?php
if(count($data) > 0)
{
	foreach($data as $k=>$v)
	{
		echo "<tr><td>$v->classname</td><td>$v->name</td><td>$v->mobilephone</td></tr>";
		
	}
}else
	echo "<tr><td colspan='3'>暂无数据</td></tr>"; 
?>
</table>

      	<?php include("footer.php");?>
</body>
</html>
<?php
}
?>