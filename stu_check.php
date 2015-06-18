<?php
require_once 'include/common.inc.php';
if($_REQUEST['act'] == 'list')
{		
	$result = array();
	$stuname = $_REQUEST['stuname'];
	$sid = $_REQUEST['sid'];
	$zhouci = $_REQUEST['zhouci'];
	$sql1 = "select a.sid,a.name,a.classid,a.dormbn,a.dormnumber,b.name as classname from student_info a left join class b on a.classid = b.id where 1";
	if($stuname)
	$sql1 .= " and a.name = '$stuname'";
	if($sid)
	$sql1 .= " and a.sid = '$sid'";
	$sidarr = $yiqi_db->get_results($sql1);
		foreach($sidarr as $k=>$v)
		{
		$score = 60;
		$id = $v->sid;
		$dormlou = $v->dormbn;
		$dormnum = $v->dormnumber;
		$sql2 = "select * from zaocao_personal where sid = '$id'";
		$zaocao=$yiqi_db->get_results($sql2);
			if(count($zaocao)>0)
			{
				foreach($zaocao as $k1=>$v1)
				{
				$kuangcaodate = $v1->kuangcaodate;
				$chidaodate = $v1->chidaodate;
				$burenzhendate = $v1->burenzhendate;
				if($kuangcaodate)
				$score = $score - 3;
				if($chidaodate)
				$score = $score - 2;
				if($burenzhendate)
				$score = $score - 2;
				}
			}
		$sql3 = "select * from wanzixi_personal where sid = '$id'";
		$wanzixi = $yiqi_db->get_results($sql3);
			if(count($wanzixi)>0)
			{
				foreach($wanzixi as $k2=>$v2)
				{
				$wanzixi_absent = $v2->kuangkedate;
				$wanzixi_chidao = $v2->chidaodate;
				$wanzixi_zaotui = $v2->zaotuidate;
				if($wanzixi_absent)
				$score = $score - 3;
				if($wanzixi_chidao)
				$score = $score - 2;
				if($wanzixi_zaotui)
				$score = $score - 2;		
				}
			}
		$sql4 = "select * from stu_absent_record where sid = '$id'";
		$kuangke = $yiqi_db->get_results($sql4);
			if(count($kuangke)>0)
			{
				foreach($kuangke as $k3=>$v3)
				{
					if($v3->absentriqi || $v3->coursename || $v3->keshi)
					$score = $score - 5;
					if($v3->chidaodate || $v3->chidaokeshi || $v3->chidaocourse)
					$score = $score - 3;
					if($v3->zaotuidate || $v3->zaotuikeshi || $v3->zaotuicourse)
					$score = $score - 3;
				}
			}
		$sql5 = "select * from weisheng_yuanji where dormlou ='$dormlou' and dormnum = '$dormnum'";
		$dorm = $yiqi_db->get_results($sql5);
			if(count($dorm)>0)
			{
				foreach($dorm as $k4=>$v4)
				{
				$dorm_score = $v4->score;
				if($dorm_score >= 95)
				$score = $score + 2;
				if($dorm_score >= 75 && $dorm_score <= 84)
				$score = $score - 1;
				if($dorm_score < 75)
				$score = $score - 2;
				}
			}
		$sql6 = "select * from weisheng_sch where dormlou = '$dormlou' and dormnum = '$dormnum'";
		$dorm_sch = $yiqi_db->get_results($sql6);	
			if(count($dorm_sch)>0)
			{
				foreach($dorm_sch as $k5=>$v5)
				{
				$score_sch = $v5->score;
				if($score_sch == '优秀')
				$score = $score + 3;
				if($score_sch == '不合格')
				$score = $score - 2;
				}
			}
		$sql7 = "select * from dormzhian where sid = '$id'";
		$zhian = $yiqi_db->get_results($sql7);	
			if(count($zhian)>0)
			{
				foreach($zhian as $k6=>$v6)
				{
					$weiji = $v6->weiji;
					if($weiji == '夜不归宿')
					$score = $score - 5;
					if($weiji == '晚归')
					$score = $score - 2;
					if($weiji == '烟头')
					$score = $score - 2;
					if($weiji == '大功率违章电器')
					$score = $score - 5;
				}
			}
			$data = array('sid'=>$id,'name'=>$v->name,'classname'=>$v->classname,'score'=>$score);
			array_push($result,$data);
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
<body>
<div class="mainbody">
<div class="menu" style="text-align:center">
<a href="list.php">返回</a>　
<a href="check_info.php">按照周次查询</a><br>
<form action="stu_check.php" method="get" class="disin">
<input type="hidden" name="act" value="list">
按姓名查询<input type="text" name="stuname" />
按学号查询<input type="text" name="sid" />
<input type="submit" value="提交" id="submit" />
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list4">
<tr>
	<td>学号</td>
	<td>姓名</td>
	<td>班级</td>
	<td>日常考核分数</td>
</tr>

<?php
if(count($result)>0)
{
	foreach($result as $k=>$v)
	{
	echo "<tr>";
	echo "<td>$v[sid]</td>
		<td><a href='check_info.php?act=info&sid=$v[sid]'>$v[name]</a></td>
		<td>$v[classname]</td>
		<td>$v[score]</td>";
	echo "</tr>";
	}
}else{
echo "<tr><td colspan='4'>没有找到对应的学生！</td></tr>";
}
?>

</table>
</div>
</body>
</html>