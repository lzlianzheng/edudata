<?php
require_once 'include/common.inc.php';

$sid = $_REQUEST['sid'];
$sql = "select a.sid,a.name,a.classid,a.dormbn,a.dormnumber,b.name as classname from student_info a left join class b on a.classid = b.id where a.sid = '$sid'";
$sidarr = $yiqi_db->get_row($sql);
$scholar = $yiqi_db->get_results("select * from scholarship where sid = '$sid'");
$honour = $yiqi_db->get_results("select * from stuhonour where sid = '$sid'");
$kuangke = $yiqi_db->get_results("select * from stu_absent_record where sid = '$sid'");
$wanzixi = $yiqi_db->get_results("select * from wanzixi_personal where sid = '$sid'");
$zaocao = $yiqi_db->get_results("select * from zaocao_personal where sid = '$sid'");
$zhian = $yiqi_db->get_results("select * from dormzhian where sid = '$sid'");
$prize =  $yiqi_db->get_results("select * from sbisai_prize where sid = '$sid'");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta name="robots" content="noindex,nofollow"> 
<meta name="googlebot" content="noimageindex"> 
<meta name="apple-mobile-web-app-capable" content="yes"> 
<meta name="apple-mobile-web-app-status-bar-style" content="black" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale:1.0, maximum-scale:1.0, user-scalable=no" />
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
.df{background:#eee;}
</style>
<body>
<div class="mainbody">
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr><td>
<table border="0" cellspacing="0" cellpadding="0" class="t_xyt tc"><tr>
<?php
		echo "<td width='25%' class='df'>姓名</td><td width='25%'>$sidarr->name</td>
		<td width='25%' class='df'>班级</td><td>$sidarr->classname</td>";
?>
</tr></table>
</td></tr>
<tr><td height="2"></td></tr>
<tr><td>
	<table cellspacing="0" cellpadding="0" class="t_xyt tc" width="100%">
		<?php
		if(count($scholar) > 0)
		{
			foreach($scholar as $k=>$v)
			{
			$scholarstr = $v->year.' 第'.$v->xueqi.'学期 '.$v->scholarship;
			echo "<tr><td>$scholarstr</td></tr>";
			}
		}
		if(count($honour) > 0)
		{
			foreach($honour as $k=>$v)
			{
			$honourstr = $v->year.' 第'.$v->xueqi.'学期 '.$v->jibie.' '.$v->honourname;
			echo "<tr><td>$honourstr</td></tr>";
			}
		}
		if(count($prize) > 0)
		{
			foreach($prize as $k=>$v)
			{
				$prizestr = $v->prizeyear." 第".$v->prizexueqi."学期 ".$v->level." ".$v->prizename." ".$v->prizegrade;
				echo "<tr><td>$prizestr</td></tr>";
			}
		}
		if(count($kuangke) > 0)
		{
			foreach($kuangke as $k=>$v)
			{
				if($v->keshi || $v->coursename || $v->absentriqi)
				{
				$absentstr = $v->year.' 第'.$v->xueqi.'学期'.' 第'.$v->zhouci.'周'.' '.$v->absentriqi.' '.$v->coursename.' 第'.$v->keshi.'课时旷课';
				echo "<tr><td>$absentstr</td></tr>";
				}
				if($v->chidaokeshi || $v->chidaocourse || $v->chidaodate)
				{
				$chidaostr = $v->year.' 第'.$v->xueqi.'学期'.' 第'.$v->zhouci.'周'.' '.$v->chidaodate.' '.$v->chidaocourse.' 第'.$v->chidaokeshi.'课时迟到';
				echo "<tr><td>$chidaostr</td></tr>";
				}
				if($v->zaotuikeshi || $v->zaotuicourse || $v->zaotuidate)
				{
				$zaotuistr = $v->year.' 第'.$v->xueqi.'学期'.' 第'.$v->zhouci.'周'.' '.$v->zaotuidate.' '.$v->zaotuicourse.' 第'.$v->zaotuikeshi.'课时早退';
				echo "<tr><td>$zaotuistr</td></tr>";
				}
				
			
			}
		}
		if(count($wanzixi)>0)
		{
		foreach($wanzixi as $k=>$v)
		{
			if($v->kuangkedate)
			{
			$wanzixi = $v->year.' 第'.$v->xueqi.'学期'.' 第'.$v->zhouci.'周'.' '.$v->kuangkedate.'晚自习旷课';
			echo "<tr><td>$wanzixi</td></tr>";
			}
			if($v->chidaodate)
			{
			$wanzixi_chidao = $v->year.' 第'.$v->xueqi.'学期'.' 第'.$v->zhouci.'周'.' '.$v->chidaodate.'晚自习迟到';
			echo "<tr><td>$wanzixi_chidao</td></tr>";
			}
			if($v->zaotuidate)
			{
			$wanzixi_zaotui = $v->year.' 第'.$v->xueqi.'学期'.' 第'.$v->zhouci.'周'.' '.$v->zaotuidate.'晚自习早退';
			echo "<tr><td>$wanzixi_zaotui</td></tr>";
			}
		}
		}
		if(count($zaocao)>0)
		{
			foreach($zaocao as $k=>$v)
			{
				if($v->kuangcaodate)
				{
				$kuangcao = $v->year.' 第'.$v->xueqi.'学期'.' 第'.$v->zhouci.'周'.' '.$v->kuangcaodate.'早操旷操';
				echo "<tr><td>$kuangcao</td></tr>";
				}
				if($v->chidaodate)
				{
				$zaocao_chidao = $v->year.' 第'.$v->xueqi.'学期'.' 第'.$v->zhouci.'周'.' '.$v->chidaodate.'早操迟到';
				echo "<tr><td>$zaocao_chidao</td></tr>";
				}
				if($v->burenzhendate)
				{
				$zaocao_burenzhen = $v->year.' 第'.$v->xueqi.'学期'.' 第'.$v->zhouci.'周'.' '.$v->burenzhendate.'早操不认真';
				echo "<tr><td>$zaocao_burenzhen</td></tr>";
				}
			}	
		}
		if(count($zhian)>0)
		{
			foreach($zhian as $k=>$v)
			{
			$weiji = $v->year.' 第'.$v->xueqi.'学期'.' 第'.$v->zhouci.'周'.' '.$v->time.' '.$v->jibie.' '.$v->weiji;
			echo "<tr><td>$weiji</td></tr>";
			}	
		}
		?>
	</table>
</td></tr>
</table>
</div>
</body>
</html>
