<?php
require_once 'include/common.inc.php';
$stararr = array("","一星","二星","三星","四星","五星");
if($_REQUEST['act'] == 'info')
{
	$zhouci = $_REQUEST['zhouci']; 
	$sid = $_REQUEST['sid'];
	if($sid)
	{
	$sql = "select a.sid,a.name,a.classid,a.dormbn,a.dormnumber,b.name as classname from student_info a left join class b on a.classid = b.id where 1";
	if($sid)
	$sql .= " and a.sid = '$sid'";
	$sidarr = $yiqi_db->get_row($sql);
	$id = $sidarr->sid;
	$dormlou = $sidarr->dormbn;
	$dormnum = $sidarr->dormnumber;
	$sql1 = "select * from zaocao_personal where sid=$id";
	if($zhouci)
	$sql1 .= " and zhouci = '$zhouci'";
	$zaocao = $yiqi_db->get_results($sql1);
	$sql2 = "select * from wanzixi_personal where sid = $id";
	if($zhouci)
	$sql2 .= " and zhouci = '$zhouci'";
	$wanzixi = $yiqi_db->get_results($sql2);
	$sql3 = "select * from stu_absent_record where sid = $id";
	if($zhouci)
	$sql3 .= " and zhouci = '$zhouci'";
	$kuangke = $yiqi_db->get_results($sql3);
	$sql4 = "select * from weisheng_yuanji where dormlou = '$dormlou' and dormnum = '$dormnum'";
	if($zhouci)
	$sql4 .= " and zhouci = '$zhouci'";
	$yuanji =  $yiqi_db->get_results($sql4);
	$sql6 = "select * from weisheng_sch where dormlou = '$dormlou' and dormnum = '$dormnum'";
	if($zhouci)
	$sql6 .= " and zhouci = '$zhouci'";
	$sch =  $yiqi_db->get_results($sql6);
	$sql5 = "select * from dormzhian where sid = $id";
	if($zhouci)
	$sql5 .= " and zhouci = '$zhouci'";
	$zhian = $yiqi_db->get_results($sql5);
	$sql7 = "select * from sushe_star where dormlou = '$dormlou' and dormnum = '$dormnum'";
	$sushe_star = $yiqi_db->get_results($sql7);
	}else
	{
		showMsg("请先输入学号！","back");
	}
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
<div class="menu" style="text-align:center">
<a href="stu_check.php">返回</a>　
<form action="check_info.php" method="get" class="disin">
<input type="hidden" name="act" value="info">
按学号查询<input type="text" name="sid" value="<?php echo $sid ?>" />
周次<input type="text" name="zhouci" size="5" />
<input type="submit" value="提交" id="submit" />
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list4">
<tr>
<?php
		echo "<td>学号</td><td>$sidarr->sid</td>
		<td>姓名</td><td>$sidarr->name</td>
		<td>班级</td><td>$sidarr->classname</td>
		<td>周次</td><td width='50'>$zhouci</td>";
?>
</tr>
<tr><td colspan="8">课堂</td></tr>
<tr><td>课程名称/课时</td><td>旷课日期</td><td>课程名称/课时</td><td>迟到日期</td><td>课程名称/课时</td><td>早退日期</td><td colspan="2">合计</td></tr>
<?php
if(count($kuangke)>0)
{	
	$kuangke_score = 0;
	$row1 = count($kuangke);
	foreach($kuangke as $m=>$n)
	{
		if($n->absentriqi || $n->coursename || $n->keshi)
		$kuangke_score = $kuangke_score - 5;
		if($n->chidaodate || $n->chidaokeshi || $n->chidaocourse)
		$kuangke_score = $kuangke_score - 3;
		if($n->zaotuidate || $n->zaotuikeshi || $n->zaotuicourse)
		$kuangke_score = $kuangke_score - 3;
		
	}
	foreach($kuangke as $k=>$v)
	{
		$keshi = $v->keshi ? "/".$v->keshi : "";
		$chidaokeshi = $v->chidaokeshi ? "/".$v->chidaokeshi :"";
		$zaotuikeshi = $v->zaotuikeshi ? "/".$v->zaotuikeshi : "";
		$kuangke = $v->coursename . $keshi;
		$chidao = $v->chidaocourse . $chidaokeshi;
		$zaotui = $v->zaotuicourse . $zaotuikeshi;
		if($k == 0)
		echo "<tr><td>$kuangke</td><td>$v->absentriqi</td><td>$chidao</td><td>$v->chidaodate</td><td>$zaotui</td><td>$v->zaotuidate</td><td colspan='2' rowspan='$row1'>$kuangke_score</td></tr>";
		else
		echo "<tr><td>$kuangke</td><td>$v->absentriqi</td><td>$chidao</td><td>$v->chidaodate</td><td>$zaotui</td><td>$v->zaotuidate</td></tr>";
	}
}else
{
	echo "<tr><td colspan='8'>暂无记录</td></tr>";
}
?>

<tr><td colspan="8">早操</td></tr>
<tr><td colspan="2">旷操日期</td><td colspan="2">迟到日期</td><td colspan="2">不认真日期</td><td colspan="2">合计</td></tr>
<?php
if(count($zaocao)>0)
{	
	$zaocao_score = 0;
	foreach($zaocao as $m=>$n)
	{
		if($n->kuangcaodate)
		$zaocao_score = $zaocao_score - 3;
		if($n->chidaodate)
		$zaocao_score = $zaocao_score - 2;
		if($n->burenzhendate)
		$zaocao_score = $zaocao_score - 2;
	}
	$row2 = count($zaocao);
	foreach($zaocao as $k1=>$v1)
		{
			if($k1 == 0)
			echo "<tr><td colspan='2'>$v1->kuangcaodate</td><td colspan='2'>$v1->chidaodate</td><td colspan='2'>$v1->burenzhendate</td><td colspan='2' rowspan='$row2'>$zaocao_score</td></tr>";
			else
			echo "<tr><td colspan='2'>$v1->kuangcaodate</td><td colspan='2'>$v1->chidaodate</td><td colspan='2'>$v1->burenzhendate</td></tr>";
		}
}else
{
	echo "<tr><td colspan='8'>暂无记录</td></tr>";
}
?>

<tr><td colspan="8">晚自习</td></tr>
<tr><td colspan="2">旷课日期</td><td colspan="2">迟到日期</td><td colspan="2">早退日期</td><td colspan="2">合计</td></tr>
<?php
if(count($wanzixi)>0)
{	
	$wanzixi_score = 0;
	foreach($wanzixi as $m=>$n)
	{
		if($n->kuangkedate)
		$wanzixi_score = $wanzixi_score - 3;
		if($n->chidaodate)
		$wanzixi_score = $wanzixi_score - 2;
		if($n->zaotuidate)
		$wanzixi_score = $wanzixi_score - 2;
	}
	$row3 = count($wanzixi);
	foreach($wanzixi as $k2=>$v2)
	{
		if($k2 == 0)
		echo "<tr><td colspan='2'>$v2->kuangkedate</td><td colspan='2'>$v2->chidaodate</td><td colspan='2'>$v2->zaotuidate</td><td colspan='2' rowspan='$row3'>$wanzixi_score</td></tr>";
		else
		echo "<tr><td colspan='2'>$v2->kuangkedate</td><td colspan='2'>$v2->chidaodate</td><td colspan='2'>$v2->zaotuidate</td></tr>";
	}
}else
{
	echo "<tr><td colspan='8'>暂无记录</td></tr>";
}
?>
<tr><td colspan="8">公寓卫生</td></tr>
<tr><td colspan="2">级别</td><td colspan="2">日期</td><td colspan="2">得分</td><td colspan='2'>合计</td></tr>
<?php
if(count($yuanji) > 0)
{	
	$yuanji_score = 0;
	$rnow = count($yuanji);
	foreach($yuanji as $k=>$v)
	{
	if($v->score >= 95)
	$yuanji_score = $yuanji_score + 1;
	if($v->score >= 84 && $v->score <= 75)
	$yuanji_score = $yuanji_score - 1;
	if($v->score < 75)
	$yuanji_score = $yuanji_score - 2;
	}
	echo "<tr><td colspan='2' rowspan='$rnow'>院级</td>";
	foreach($yuanji as $k=>$v)
	{
	if($k == 0)
	echo "<td colspan='2'>$v->checkdate</td><td colspan='2'>$v->score</td><td colspan='2' rowspan='$rnow'>$yuanji_score</td></tr>";
	else
	echo "<td colspan='2'>$v->checkdate</td><td colspan='2'>$v->score</td></tr>";
	}
}else
{
	echo "<tr><td colspan='2'>院级</td><td colspan='6'>暂无记录</td></tr>";
}
if(count($sch)>0)
{	
	$sch_score = 0;
	$rnew = count($sch);
	foreach($sch as $k=>$v)
	{
		if($v->score == '优秀')
		$sch_score = $sch_score + 2;
		if($v->score == '不合格')
		$sch_score = $sch_score - 2;
	}
	echo "<tr><td colspan='2' rowspan='$rnew'>校级</td>";
	foreach($sch as $k=>$v)
	{
	if($k == 0)
	echo "<td colspan='2'>$v->checkdate</td><td colspan='2'>$v->score</td><td colspan='2' rowspan='$rnew'>$sch_score</td></tr>";
	else
	echo "<td colspan='2'>$v->checkdate</td><td colspan='2'>$v->score</td></tr>";
	}
}else
{
	echo "<tr><td colspan='2'>校级</td><td colspan='6'>暂无记录</td></tr>";
}
if(count($sushe_star)>0)
{	
	$star_now = 0;
	$rnew = count($sushe_star);
	echo "<tr><td colspan='2' rowspan='$rnew'>星级宿舍</td>";
	foreach($sushe_star as $k=>$v)
	{
		$star_now += $star_score[$v->score];
	$datenew = $v->year."学年 ".$v->month."月";
	if($k == 0)
	echo "<td colspan='2'>$datenew</td><td colspan='2'>".$stararr[$v->score]."</td><td colspan='2' rowspan='$rnew'>$star_now</td></tr>";
	else
	echo "<td colspan='2'>$datenew</td><td colspan='2'>".$stararr[$v->score]."</td></tr>";
	}
}else
{
	echo "<tr><td colspan='2'>星级宿舍</td><td colspan='6'>暂无记录</td></tr>";
}
?>
<tr><td colspan="8">公寓考勤</td></tr>
<tr><td colspan="2">违纪类别</td><td colspan="2">时间</td><td colspan="2">级别</td><td colspan="2">合计</td></tr>
<?php
if(count($zhian)>0)
{
	$zhian_score = 0;
	$row6 = count($zhian);
	foreach($zhian as $k=>$v)
	{
		if($v->weiji == '夜不归宿')
		$zhian_score = $zhian_score - 5;
		if($v->weiji == '晚归')
		$zhian_score = $zhian_score - 2;
		if($v->weiji == '烟头')
		$zhian_score = $zhian_score - 2;
		if($v->weiji == '大功率违章电器')
		$zhian_score = $zhian_score - 5;
		
	}
	
	foreach($zhian as $k=>$v)
	{
		if($k == 0)
		{
			if($v->weiji == '夜不归宿')
			echo "<tr><td colspan='2'>$v->weiji</td><td colspan='2'>$v->time</td><td colspan='2'>$v->jibie</td><td colspan='2' rowspan='$row6'>$zhian_score</td></tr>";
			if($v->weiji == '晚归')
			echo "<tr><td colspan='2'>$v->weiji</td><td colspan='2'>$v->time</td><td colspan='2'>$v->jibie</td><td colspan='2'  rowspan='$row6'>$zhian_score</td></tr>";
			if($v->weiji == '烟头')
			echo "<tr><td colspan='2'>$v->weiji</td><td colspan='2'>$v->time</td><td colspan='2'>$v->jibie</td><td colspan='2'  rowspan='$row6'>$zhian_score</td></tr>";
			if($v->weiji == '大功率违章电器')
			echo "<tr><td colspan='2'>$v->weiji</td><td colspan='2'>$v->time</td><td colspan='2'>$v->jibie</td><td colspan='2'  rowspan='$row6'>$zhian_score</td></tr>";
		}
		else
		{
			if($v->weiji == '夜不归宿')
			echo "<tr><td colspan='2'>$v->weiji</td><td colspan='2'>$v->time</td><td colspan='2'>$v->jibie</td><td colspan='2'></td></tr>";
			if($v->weiji == '晚归')
			echo "<tr><td colspan='2'>$v->weiji</td><td colspan='2'>$v->time</td><td colspan='2'>$v->jibie</td><td colspan='2'></td></tr>";
			if($v->weiji == '烟头')
			echo "<tr><td colspan='2'>$v->weiji</td><td colspan='2'>$v->time</td><td colspan='2'>$v->jibie</td><td colspan='2'></td></tr>";
			if($v->weiji == '大功率违章电器')
			echo "<tr><td colspan='2'>$v->weiji</td><td colspan='2'>$v->time</td><td colspan='2'>$v->jibie</td><td colspan='2'></td></tr>";
		}
	}
}else
{
	echo "<tr><td colspan='8'>暂无记录</td></tr>";
}
?>
</table>
</div>
</body>
</html>
