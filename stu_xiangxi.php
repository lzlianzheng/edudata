<?php
require_once 'include/common.inc.php';
if($_REQUEST['act']=='stat')
{
$sid = $_GET["sid"];
$sql1="select sid,name from student_info where sid=$sid";
$re1=$yiqi_db->get_row($sql1);
$sql2="select sid,name,year,xueqi,scholarship from scholarship where sid=$sid";
$re2=$yiqi_db->get_results($sql2);
$sql3="select sid,name,year,xueqi,honourname,jibie from stuhonour where sid=$sid";
$re3=$yiqi_db->get_results($sql3);
}
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
	$("select[name=s_major]").change(function(){
		$.get("jsondata.php?type=class&mid="+$(this).val(),null,function(data){
			$("select[name=s_class]").html(data);
		});
	});
});
</script>
<body>
<div class="mainbody">
<div class="menu tc">
　

<form action="stu_xiangxi.php" method="get" class="disin">
<input type="hidden" name="act" value="stat">
请输入学号<input type="text" name="sid" size=20 value="<?php echo $sid; ?>"/>　
<input type="submit" value="查 询" id="submit" />　　　　　
</form>
</div>

<table cellspacing="0" cellpadding="0" class="t_list tc list4">
<tr>
	<td width="150">学号</td>
	<td><?php echo $re1->sid; ?></td>
	<td width="150">姓名</td>
<td><?php echo $re1->name; ?></td>
</tr>
<tr >
<td>奖学金获得情况</td>
<td colspan="3">
<?php
if(count($re2)>0)
{
foreach($re2 as $v)
{
$str.=$v->year."学年第".$v->xueqi."学期获得".$v->scholarship."奖学金"."<br>";;
echo $str;
}
}else
{
echo "<div>暂无数据</div>";
}
?>
</td>
</tr>
<tr>
<tr>
<td>荣誉获得情况</td>
<td colspan="3">
<?php
if(count($re3)>0)
{
foreach($re3 as $v)
{
$str.=$v->year."学年第".$v->xueqi."学期获得".$v->jibie.$v->honourname."<br>";
}
echo $str;
}else
{
echo "<div>暂无数据</div>";
}
?>
</td>
</tr>
</tr>
</table>
</div>
</body>
</html>
