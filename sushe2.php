<?php
require_once 'include/common.inc.php';
$curpage = $_GET["p"];
$curpage = (isset($curpage) && is_numeric($curpage)) ? $curpage : 1;
if($curpage<1)
	$curpage=1;
$year = $_POST["year"];
$classid=$_POST["id"];
$sql="select a.name,b.dormbn,b.dormnumber from class a left join student_info b on a.id=b.classid where year=$year && classid=$classid";
$result=$yiqi_db->get_results($sql);

$resultcount = $yiqi_db->get_row("select count(dormnumber) as c from student_info");
//print_r($resultcount);
$orderby = "";	
$total = (int)$resultcount->c;
$take = 50;
$totalpage = (int)($total % $take == 0 ? $total / $take : $total / $take + 1);
$curpage = ($totalpage == 0)? 1 : (($curpage > $totalpage)? $totalpage : $curpage) ;
$skip = ($curpage - 1) * $take;
$result = $yiqi_db->get_results($sql . $orderby . " limit $skip,$take ");
//$classpara = globalpara("class");
//$nationpara = globalpara("nation");
$url = "sushe.php?";
$pagerhtml = pager($totalpage,$curpage,$url);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="images/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="images/jquery-1.6.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#pagego_do").click(function(){
		v = parseInt($("#pagego").val()); 
		if(v > <?php echo $totalpage; ?> || isNaN(v))
		{
			alert("请输入正确的页码。");
		}else
		{ 
			window.location.href="<?php echo $url; ?>p=" + v;
		}
	});
});
</script>
<body>
<div class="mainbody">
<div class="menu">
	<form action="" method="post">
		入学年份：<input type="text" name="year"/>
		班级：<input type="text" name="id"/>
		<input type="submit" value="查询">
	</form>
<table cellspacing="0" cellpadding="0" class="t_list tc">
	<tr>
	<td>楼号</td>
	<td>班级</td>
	<td>宿舍号</td>
	</tr>
	<?php
if(count($result) > 0){
	foreach($result as $v){
		echo "<tr>
			<td>$v->dormbn</td>
			<td>$v->name</td>
			<td>$v->dormnumber</td>
			</tr>";
	}
}
?>
</table>
<?php
 if($totalpage > 1)
 {	
	echo '<div class="pager">总计 '.$total.' 条记录，每页 '.$take.' 条，共 '.$totalpage.' 页。　　　　　到第<input type="text" id="pagego" />页 <input type="button" value=" GO " id="pagego_do" />　'.$pagerhtml.'</div>';
 }
?>
</body>
</html>

