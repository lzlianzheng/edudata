<?php
require_once 'include/common.inc.php';
$sid = $_REQUEST['sid'];
//$zhouci = $_REQUEST['zhouci']; 
$year = $_REQUEST['year'];
$xueqi = $_REQUEST['xueqi'];
	$score = 60;
	$sql = "select a.sid,a.name,a.classid,a.dormbn,a.dormnumber,b.name as classname from student_info a left join class b on a.classid = b.id where a.sid = '$sid'";
	$sidarr = $yiqi_db->get_row($sql);
	$id = $sidarr->sid;
	$dormlou = $sidarr->dormbn;
	$dormnum = $sidarr->dormnumber;
	//$sql1 = "select * from zaocao_personal where sid='$id' and year = '$year' and xueqi = '$xueqi' and zhouci = '$zhouci'";
	$sql1 = "select * from zaocao_personal where sid='$id' and year = '$year' and xueqi = '$xueqi'";
	$zaocao = $yiqi_db->get_results($sql1);
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
		$score = $score + $zaocao_score;
	}
	//$sql2 = "select * from wanzixi_personal where sid = '$id' and year = '$year' and xueqi = '$xueqi' and zhouci = '$zhouci'";
	$sql2 = "select * from wanzixi_personal where sid = '$id' and year = '$year' and xueqi = '$xueqi'";
	$wanzixi = $yiqi_db->get_results($sql2);
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
		$score = $score + $wanzixi_score;
	}
	$sql3 = "select * from stu_absent_record where sid = '$id' and year = '$year' and xueqi = '$xueqi'";
	$kuangke = $yiqi_db->get_results($sql3);
	if(count($kuangke)>0)
	{	
		$kuangke_score = 0;
		foreach($kuangke as $m=>$n)
		{
			if($n->absentriqi || $n->coursename || $n->keshi)
			{
			$kuangke_score = $kuangke_score - 5;
			}
			if($n->chidaodate || $n->chidaokeshi || $n->chidaocourse)
			{
			$kuangke_score = $kuangke_score - 3;
			}
			if($n->zaotuidate || $n->zaotuikeshi || $n->zaotuicourse)
			{
			$kuangke_score = $kuangke_score - 3;
			}
			
		}
		$score = $score + $kuangke_score;
	}
	$sql4 = "select * from weisheng_yuanji where year = '$year' and xueqi = '$xueqi' and  dormlou = '$dormlou' and dormnum = '$dormnum'";
	$yuanji =  $yiqi_db->get_results($sql4);
	if(count($yuanji) > 0)
	{	
		$yuanji_score = 0;
		foreach($yuanji as $k=>$v)
		{
		if($v->score >= 95)
		$yuanji_score = $yuanji_score + 2;
		if($v->score >= 84 && $v->score <= 75)
		$yuanji_score = $yuanji_score - 1;
		if($v->score < 75)
		$yuanji_score = $yuanji_score - 2;
		}
		$score = $score + $yuanji_score;
	}
	$sql6 = "select * from weisheng_sch where year = '$year' and xueqi = '$xueqi' and  dormlou = '$dormlou' and dormnum = '$dormnum'";
	$sch =  $yiqi_db->get_results($sql6);
	if(count($sch)>0)
	{	
		$sch_score = 0;
		foreach($sch as $k=>$v)
		{
			if($v->score == '优秀')
			$sch_score = $sch_score + 3;
			if($v->score == '不合格')
			$sch_score = $sch_score - 2;
		}
		$score = $score + $sch_score;
	}
	$sql5 = "select * from dormzhian where sid='$id' and year = '$year' and xueqi = '$xueqi'";
	$zhian = $yiqi_db->get_results($sql5);
	if(count($zhian)>0)
	{
		$zhian_score = 0;
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
			if($v->weiji == '态度恶劣')
			$zhian_score = $zhian_score - 5;
			if($v->weiji == '抽烟')
			$zhian_score = $zhian_score - 5;
			if($v->weiji == '打火机')
			$zhian_score = $zhian_score - 2;
			if($v->weiji == '烟')
			$zhian_score = $zhian_score - 2;
			
		}
		$score = $score + $zhian_score;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<script type="text/javascript" src="images/jquery-1.6.1.min.js"></script>
<style>
*{ margin:0px; padding:0px; }
body { font-size:12px; line-height:25px; }
img { border:0px; }
a:link,a:visited { color:#00f; text-decoration:none; }
a:hover { text-decoration:underline; }
li {list-style-type:none; }
.tl {text-align:left; }
.tc {text-align:center; }
.tr {text-align:right; }
.fl {float:left; }
.fr {float:right; }
.mainbody{padding:10px;}
.list {padding:20px;font-size:14px;}
.list a{display:block;}
.menu{padding:0 10px;}
.t_xyt{border-collapse:collapse;width:100%;}
.xyt{width:100%;margin:auto;}
.t_xyt td{border:1px solid #ccc;padding:5px;line-height:20px;}
</style>
<body>
<div class="mainbody">
<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td>
<table cellspacing="0" cellpadding="0" class="t_xyt tc">
<tr>
<?php
		echo "<td width='15%'>姓名</td><td width='15%'>$sidarr->name</td>
		<td width='15%'>班级</td><td>$sidarr->classname</td>
		<td width='15%'>总分</td><td width='15%'>$score</td>";
?>
</tr>
</table>
</td></tr>
<tr><td height="2"></td></tr>
<tr><td>
<table cellspacing="0" cellpadding="0" class="t_xyt tc">
<tr><td colspan="4">课堂</td></tr>
<tr><td width="30%">旷课日期</td><td width="30%">迟到日期</td><td width="30%">早退日期</td><td width="10%">合计</td></tr>
<?php
if(count($kuangke)>0)
{	
	$row1 = count($kuangke);
	foreach($kuangke as $k=>$v)
	{
		$keshi = $v->keshi ? "/".$v->keshi : "";
		$chidaokeshi = $v->chidaokeshi ? "/".$v->chidaokeshi :"";
		$zaotuikeshi = $v->zaotuikeshi ? "/".$v->zaotuikeshi : "";
		$kuangke = $v->coursename . $keshi;
		$chidao = $v->chidaocourse . $chidaokeshi;
		$zaotui = $v->zaotuicourse . $zaotuikeshi;
		if($k == 0)
		echo "<tr><td>$kuangke<br>$v->absentriqi</td><td>$chidao<br>$v->chidaodate</td><td>$zaotui<br>$v->zaotuidate</td><td rowspan='$row1'>$kuangke_score</td></tr>";
		else
		echo "<tr><td>$kuangke<br>$v->absentriqi</td><td>$chidao<br>$v->chidaodate</td><td>$zaotui<br>$v->zaotuidate</td></tr>";
	}
}else
{
	echo "<tr><td colspan='4'>暂无记录</td></tr>";
}
?>

<tr><td colspan="4">早操</td></tr>
<tr><td width="30%">旷操日期</td><td width="30%">迟到日期</td><td width="30%">不认真日期</td><td width="10%">合计</td></tr>
<?php
if(count($zaocao)>0)
{	
	$row2 = count($zaocao);
	foreach($zaocao as $k1=>$v1)
		{
			if($k1 == 0)
			echo "<tr><td>$v1->kuangcaodate</td><td>$v1->chidaodate</td><td>$v1->burenzhendate</td><td rowspan='$row2'>$zaocao_score</td></tr>";
			else
			echo "<tr><td>$v1->kuangcaodate</td><td>$v1->chidaodate</td><td>$v1->burenzhendate</td></tr>";
		}
}else
{
	echo "<tr><td colspan='4'>暂无记录</td></tr>";
}
?>

<tr><td colspan="4">晚自习</td></tr>
<tr><td width="30%">旷课日期</td><td width="30%">迟到日期</td><td width="30%">早退日期</td><td width="10%">合计</td></tr>
<?php
if(count($wanzixi)>0)
{	
	$row3 = count($wanzixi);
	foreach($wanzixi as $k2=>$v2)
	{
		if($k2 == 0)
		echo "<tr><td>$v2->kuangkedate</td><td>$v2->chidaodate</td><td>$v2->zaotuidate</td><td rowspan='$row3'>$wanzixi_score</td></tr>";
		else
		echo "<tr><td>$v2->kuangkedate</td><td>$v2->chidaodate</td><td>$v2->zaotuidate</td></tr>";
	}
}else
{
	echo "<tr><td colspan='4'>暂无记录</td></tr>";
}
?>
<tr><td colspan="4">公寓卫生</td></tr>
<tr><td width="30%">级别</td><td width="30%">日期</td><td  width="30%">得分</td><td width="10%">合计</td></tr>
<?php
if(count($yuanji) > 0)
{	
	$rnow = count($yuanji);
	echo "<tr><td rowspan='$rnow'>院级</td>";
	foreach($yuanji as $k=>$v)
	{
	$datenew = "第".$v->zhouci."周　".$v->checkdate;
	if($k == 0)
	echo "<td>$datenew</td><td>$v->score</td><td rowspan='$rnow'>$yuanji_score</td></tr>";
	else
	echo "<td>$datenew</td><td>$v->score</td></tr>";
	}
}else
{
	echo "<tr><td>院级</td><td colspan='3'>暂无记录</td></tr>";
}
if(count($sch)>0)
{	
	$rnew = count($sch);
	echo "<tr><td rowspan='$rnew'>校级</td>";
	foreach($sch as $k=>$v)
	{
	$datenow = "第".$v->zhouci."周　".$v->checkdate;
	if($k == 0)
	echo "<td>$v->$datenow</td><td>$v->score</td><td rowspan='$rnew'>$sch_score</td></tr>";
	else
	echo "<td>$v->$datenow</td><td>$v->score</td></tr>";
	}
}else
{
	echo "<tr><td>校级</td><td colspan='3'>暂无记录</td></tr>";
}
?>
<tr><td colspan="4">公寓考勤</td></tr>
<tr><td width="30%">违纪类别</td><td width="30%">时间</td><td width="30%">级别</td><td width="10%">合计</td></tr>
<?php
if(count($zhian)>0)
{
	$row6 = count($zhian);	
	foreach($zhian as $k=>$v)
	{
		if($k == 0)
		{
			echo "<tr><td>$v->weiji</td><td>$v->time</td><td>$v->jibie</td><td rowspan='$row6'>$zhian_score</td></tr>";
		}
		else
		{
			echo "<tr><td>$v->weiji</td><td>$v->time</td><td>$v->jibie</td></tr>";
		}
	}
}else
{
	echo "<tr><td colspan='4'>暂无记录</td></tr>";
}
?>
</table>
</td></tr></table>
</div>
</body>
</html>