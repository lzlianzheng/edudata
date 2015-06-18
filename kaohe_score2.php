<?php
require_once 'include/common.inc.php';
$yeardata = array('2011-2012','2012-2013','2013-2014','2014-2015','2015-2016','2016-2017','2017-2018','2018-2019','2019-2020','2020-2021');
if($_GET["act"] == "kaohe_score" || $_GET["act"] == "out")
{
	$cid = $_GET["s_class"];
	$year = $_GET['xuenian'];
	$xueqi = $_GET['xueqi'];
	$zhouci = 0;
	$newxueqi = 0;
	$sql = "select a.sid,a.name,a.classid,a.dormbn,a.dormnumber,b.name as classname from student_info a left join class b on a.classid = b.id where 1";
	if($cid)
	{
	$sql .=" and b.id='$cid'";
	}
	$data = $yiqi_db->get_results($sql);
	$result = array();
	foreach($data as $k=>$v)
	{
		$score = 60;
		$id = $v->sid;
		$classname = $v->classname;
		$dormlou = $v->dormbn;
		$dormnum = $v->dormnumber;
		$sql2 = "select * from zaocao_personal where sid = '$id'";
		if($year)
		$sql2 .= " and year = '$year'";
		if($xueqi)
		$sql2 .= " and xueqi = '$xueqi'";
		$zaocao=$yiqi_db->get_results($sql2);
			if(count($zaocao)>0)
			{
				foreach($zaocao as $k1=>$v1)
				{
				$newzhouci = $v1->zhouci;
				$newxueqi = $v->xueqi;
				$zhouci = ($newzhouci >= $zhouci) ? $newzhouci : $zhouci;
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
		if($year)
		$sql3 .= " and year = '$year'";
		if($xueqi)
		$sql3 .= " and xueqi = '$xueqi'";
		$wanzixi = $yiqi_db->get_results($sql3);
			if(count($wanzixi)>0)
			{
				foreach($wanzixi as $k2=>$v2)
				{
				$newzhouci = $v2->zhouci;
				$zhouci =($newzhouci >= $zhouci) ? $newzhouci : $zhouci;
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
		if($year)
		$sql4 .= " and year = '$year'";
		if($xueqi)
		$sql4 .= " and xueqi = '$xueqi'";
		$kuangke = $yiqi_db->get_results($sql4);
			if(count($kuangke)>0)
			{
				foreach($kuangke as $k3=>$v3)
				{
					$newzhouci = $v3->zhouci;
					$zhouci =($newzhouci >= $zhouci) ? $newzhouci : $zhouci;
					if($v3->absentriqi || $v3->coursename || $v3->keshi)
					$score = $score - 5;
					if($v3->chidaodate || $v3->chidaokeshi || $v3->chidaocourse)
					$score = $score - 3;
					if($v3->zaotuidate || $v3->zaotuikeshi || $v3->zaotuicourse)
					$score = $score - 3;
				}
			}
		$sql5 = "select * from weisheng_yuanji where dormlou ='$dormlou' and dormnum = '$dormnum'";
		if($year)
		$sql5 .= " and year = '$year'";
		if($xueqi)
		$sql5 .= " and xueqi = '$xueqi'";
		$dorm = $yiqi_db->get_results($sql5);
			if(count($dorm)>0)
			{
				foreach($dorm as $k4=>$v4)
				{
				$newzhouci = $v4->zhouci;
				$zhouci =($newzhouci >= $zhouci) ? $newzhouci : $zhouci;
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
		if($year)
		$sql6 .= " and year = '$year'";
		if($xueqi)
		$sql6 .= " and xueqi = '$xueqi'";
		$dorm_sch = $yiqi_db->get_results($sql6);	
			if(count($dorm_sch)>0)
			{
				foreach($dorm_sch as $k5=>$v5)
				{
				$newzhouci = $v5->zhouci;
				$zhouci =($newzhouci >= $zhouci) ? $newzhouci : $zhouci;
				$score_sch = $v5->score;
				if($score_sch == '优秀')
				$score = $score + 3;
				if($score_sch == '不合格')
				$score = $score - 2;
				}
			}
		$sql7 = "select * from dormzhian where sid = '$id'";
		if($year)
		$sql7 .= " and year = '$year'";
		if($xueqi)
		$sql7 .= " and xueqi = '$xueqi'";
		$zhian = $yiqi_db->get_results($sql7);	
			if(count($zhian)>0)
			{
				foreach($zhian as $k6=>$v6)
				{
					$newzhouci = $v6->zhouci;
					$zhouci =( $newzhouci >= $zhouci) ? $newzhouci : $zhouci;
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
		$data = array('sid'=>$id,'name'=>$v->name,'classname'=>$v->classname,'zhouci'=>$zhouci,'xueqi'=>$xueqi,'score'=>$score);
		array_push($result,$data);
	}
}
if($_GET["act"] == "out")
{
	header("Content-type: application/vnd.ms-excel; charset=gb2312");
	Header("Content-Disposition: attachment; filename=zaocao_class_score.xls");
	$tnow = "<td>班级</td><td>学号</td><td>姓名</td><td>学期</td><td>截止周次</td><td>得分</td>";
	echo "<table border=1><tr>".$tnow."</tr>\n";
	if(count($result) > 0){
		$outc = "";
		foreach($result as $k=>$v){
				$outc .= "<tr><td>$v->name</td>
				<td>$v->year</td>
				<td>$v->xueqi</td>
				<td>$v->zhouci</td>
				<td>$v->score</td>
				<td>$v->recorder</td></tr>";
		}
		//echo iconv("utf-8","gb2312",$outc);
		echo $outc;
	}
		echo "</table>";
}else{
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

function scholar_in(id){
	year = $("select[name=sch_year]").val();
	xueqi = $("select[name=sch_xueqi]").val();
	if(!year || !xueqi){
		alert("请输入班级早操得分记录所属学年/学期");
	}else{
		$.get("./scholar_insert.php?act=zaocao_class&year="+year+"&xueqi="+xueqi,$("#"+id).serialize(),function(data){
			alert(data);
		});
	}
	return false;
}
</script>
<body>
<div class="mainbody">
<div class="menu tc">
<a href="list.php">返回</a>　　
<a href="data_in.php?name=zaocao_class">导入数据</a>　　
<a href="zaocao_class_s.php">普通录入</a>
<a href="<?php echo "zaocao_class_score.php?act=out&s_major=$mid&s_class=$cid&xuenian=$year&xueqi=$xueqi&zhouci=$zhouci";?>">导出数据</a>
<br>
<form action="kaohe_score.php" method="get" class="disin">
<input type="hidden" name="act" value="kaohe_score">
<?php
	echo " 班级 <select name='s_class'><option value=''>请选择</option>";
	$classpara=globalpara("class");
	
	foreach($classpara as $k=>$x){
		$se = ($k==$cid)? " selected " : "";
		echo "<option $se value='$k'>$x</option>";
	}
	echo "</select>";
?>
  学年<select name="xuenian"><option value=''>全部</option>
<?php
	foreach($yeardata as $v){
	$se = ($v == $xuenian)? " selected " : "";
	echo "<option $se value='$v'>$v</option>";
}
?>
</select>
学期<select name='xueqi'><option value=''>请选择</option>
	<option value="1">第一学期</option>
	<option value="2">第二学期</option>
	</select>
<input type="submit" value="查询" id="submit" />　　　　　
</form>
</div>

<table cellspacing="0" cellpadding="0" class="t_list tc list4">
<tr>
	<td>班级</td>
	<td>学号</td>
	<td>姓名</td>
	<td>学期</td>	
	<td>截止周次</td>
	<td>得分</td>	
</tr>
<?php
if(count($result)>0)
{
	foreach($result as $k=>$v)
	{
	echo "<tr>";
	echo "<td>$v[classname]</td>
		<td>$v[sid]</td>
		<td><a href='check_info.php?act=info&sid=$v[sid]'>$v[name]</a></td>
		<td>$v[xueqi]</td>
		<td>$v[zhouci]</td>
		<td>$v[score]</td>";
	echo "</tr>";
	}
}else{
echo "<tr><td colspan='6'>没有找到对应的学生！</td></tr>";
}	
?>
</table>
</div>
</body>
</html>
<?php
}
?>