<?php
require_once 'include/common.inc.php';
$stararr = array("","一星","二星","三星","四星","五星");
if($_REQUEST['act'] == 'info')
{
	$stuid = $_REQUEST['sid'];
	$sname = $_REQUEST['sname'];
	$zhouci = $_REQUEST['zhouci']; 
	$year = $_REQUEST['year'];
	$xueqi = $_REQUEST['xueqi'];
	if($year && $xueqi)
	{
		$score = 60;
		$sql = "select a.sid,a.name,a.classid,a.dormbn,a.dormnumber,b.name as classname from student_info a left join class b on a.classid = b.id where 1 ";
		$sql .= ($stuid)? " and a.sid='$stuid' " : "" ;
		$sql .= ($sname)? " and a.name='$sname' " : "" ;
		$sidarr = $yiqi_db->get_row($sql);
		$sidnow = $sidarr->sid;
		$dormlou = $sidarr->dormbn;
		$dormnum = $sidarr->dormnumber;
		$zaocao_zhouci = $yiqi_db->get_row("select max(zhouci) as zhouci from zaocao_personal");
		$max_zaocao = $zaocao_zhouci->zhouci;
		$sql1 = "select * from zaocao_personal where sid='$sidnow' and year = '$year' and xueqi = '$xueqi'";
		$sql1 .=($zhouci)? " and zhouci <= $zhouci":" and zhouci <= $max_zaocao";
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
		$wanzixi_zhouci = $yiqi_db->get_row("select max(zhouci) as zhouci from wanzixi_personal");
		$max_wanzixi = $wanzixi_zhouci->zhouci;
		//$max_zhouci = ($max_zhouci >= $max_wanzixi)? $max_zhouci : $max_wanzixi;
		$sql2 = "select * from wanzixi_personal where sid = '$sidnow' and year = '$year' and xueqi = '$xueqi'";
		$sql2 .=($zhouci)? " and zhouci <= $zhouci":" and zhouci <= $max_wanzixi";
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
		$absent_zhouci = $yiqi_db->get_row("select max(zhouci) as zhouci from stu_absent_record");
		$max_absent = $absent_zhouci->zhouci;
		//$max_zhouci = ($max_zhouci >= $max_absent)? $max_zhouci : $max_absent;
		$sql3 = "select * from stu_absent_record where sid = '$sidnow' and year = '$year' and xueqi = '$xueqi'";
		$sql3 .=($zhouci)? " and zhouci <= $zhouci":" and zhouci <= $max_absent";
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
		$yuanji_zhouci = $yiqi_db->get_row("select max(zhouci) as zhouci from weisheng_yuanji");
		$max_yuan = $yuanji_zhouci->zhouci;
		$sql4 = "select * from weisheng_yuanji where year = '$year' and xueqi = '$xueqi' and  dormlou = '$dormlou' and dormnum = '$dormnum'";
		$sql4 .=($zhouci)? " and zhouci <= $zhouci":" and zhouci <= $max_yuan";
		$yuanji =  $yiqi_db->get_results($sql4);
		if(count($yuanji) > 0)
		{	
			$yuanji_score = 0;
			foreach($yuanji as $k=>$v)
			{
			if($v->score >= 95)
			$yuanji_score = $yuanji_score + 1;
			if($v->score >= 84 && $v->score <= 75)
			$yuanji_score = $yuanji_score - 1;
			if($v->score < 75)
			$yuanji_score = $yuanji_score - 2;
			}
			$score = $score + $yuanji_score;
		}
		$sch_zhouci = $yiqi_db->get_row("select max(zhouci) as zhouci from weisheng_sch");
		$max_sch = $sch_zhouci->zhouci;
		$sql6 = "select * from weisheng_sch where year = '$year' and xueqi = '$xueqi' and  dormlou = '$dormlou' and dormnum = '$dormnum'";
		$sql6 .=($zhouci)? " and zhouci <= $zhouci":" and zhouci <= $max_sch";
		$sch =  $yiqi_db->get_results($sql6);
		if(count($sch)>0)
		{	
			$sch_score = 0;
			foreach($sch as $k=>$v)
			{
				if($v->score == '优秀')
				$sch_score = $sch_score + 2;
				if($v->score == '不合格')
				$sch_score = $sch_score - 2;
			}
			$score = $score + $sch_score;
		}
		$zhian_zhouci = $yiqi_db->get_row("select max(zhouci) as zhouci from dormzhian");
		$max_zhian = $zhian_zhouci->zhouci;
		$sql5 = "select * from dormzhian where sid='$sidnow' and year = '$year' and xueqi = '$xueqi'";
		$sql5 .=($zhouci)? " and zhouci <= $zhouci":" and zhouci <= $max_zhian";
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
		$sql7 = "select * from sushe_star where year = '$year' and xueqi = '$xueqi' and  dormlou = '$dormlou' and dormnum = '$dormnum'";
		$sushe_star = $yiqi_db->get_results($sql7);
		if(count($sushe_star) > 0){
			$star_now = 0;
			foreach($sushe_star as $v){
				$star_now += $star_score[$v->score];
			}
			$score += $star_now;
		}
	}else
	{
		ShowMsg("请选择学年/学期","back");
	}
}
$title="日常考核-个人";
include("header.php");
?>
<script type="text/javascript">
$(document).ready(function(){
	$("select[name=s_major]").change(function(){
		$.get("jsondata.php?type=stu&mid="+$(this).val(),null,function(data){
			$("select[name=s_class]").html(data);
		});
	});
});
</script>
<div class="menu" style="text-align:center">

<form action="checkinfo.php" method="get" class="disin">
<input type="hidden" name="act" value="info">
  学年<select name="year">
	<option value=''>请选择</option>
	 <?php
		foreach($yeardata as $k=>$v)
		{
		if($year == $v)
		echo "<option value='$v' selected>$v</option>";
		else
		echo "<option value='$v'>$v</option>";
		}
	 ?>
  </select>
    学期：<select name='xueqi'><option value=''>全部</option>
	<option <?php if($xueqi == 1){echo "selected";} ?> value="1">第一学期</option>
	<option <?php if($xueqi == 2){echo "selected";} ?> value="2">第二学期</option>
	</select>
	学号<input type="text" name="sid" value="">
	姓名<input type="text" name="sname" value="">
周次<input type="text" name="zhouci"  value="<?php echo $zhouci ?>" size="5" />
<input type="submit" value="提交" id="submit" />
</form>
</div>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="t_list tc list5"><tr><td>
<table cellspacing="0" cellpadding="0" class="t_xyt tc">
<tr>
<?php
		echo "<td width='10%' class='df'>学号</td><td width='10%'>$sidarr->sid</td>
		<td width='10%' class='df'>姓名</td><td width='10%'>$sidarr->name</td>
		<td width='10%' class='df'>班级</td><td width='10%'>$sidarr->classname</td>
		<td width='10%' class='df'>宿舍号</td><td width='10%'>$sidarr->dormbn-$sidarr->dormnumber</td>
		<td width='10%' class='df'>总分</td><td width='10%'>$score</td>";
?>
</tr>
</table>
</td></tr>
<tr><td height="2"></td></tr>
<tr><td>
<table cellspacing="0" cellpadding="0" class="t_xyt tc" width="100%">
<tr class="df"><td colspan="4">课堂</td></tr>
<tr class="df"><td width="30%">旷课日期</td><td width="30%">迟到日期</td><td width="30%">早退日期</td><td width="10%">合计</td></tr>
<?php
if(count($kuangke)>0)
{	
	$row1 = count($kuangke);
	foreach($kuangke as $k=>$v)
	{
		$keshi = $v->keshi ?"课时". $v->keshi : "";
		$chidaokeshi = $v->chidaokeshi ? "课时". $v->chidaokeshi :"";
		$zaotuikeshi = $v->zaotuikeshi ? "课时". $v->zaotuikeshi : "";	
		if($keshi || $v->coursename)
		{
		$kuangke_d = "第".$v->zhouci."周　".$v->coursename ."　". $keshi;
		}
		if($chidaokeshi || $v->chidaocourse)
		{
		$chidao = "第".$v->zhouci."周　".$v->chidaocourse ."　". $chidaokeshi;
		}
		if($zaotuikeshi || $v->zaotuicourse)
		{
		$zaotui = "第".$v->zhouci."周　".$v->zaotuicourse ."　". $zaotuikeshi;
		}
		if($k == 0)
		echo "<tr><td>$kuangke_d<br>$v->absentriqi</td><td>$chidao<br>$v->chidaodate</td><td>$zaotui<br>$v->zaotuidate</td><td rowspan='$row1'>$kuangke_score</td></tr>";
		else
		echo "<tr><td>$kuangke_d<br>$v->absentriqi</td><td>$chidao<br>$v->chidaodate</td><td>$zaotui<br>$v->zaotuidate</td></tr>";
	}
}else
{
	echo "<tr><td colspan='4'>暂无记录</td></tr>";
}
?>

<tr class="df"><td colspan="4">早操</td></tr>
<tr class="df"><td width="30%">旷操日期</td><td width="30%">迟到日期</td><td width="30%">不认真日期</td><td width="10%">合计</td></tr>
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

<tr class="df"><td colspan="4">晚自习</td></tr>
<tr class="df"><td width="30%">旷课日期</td><td width="30%">迟到日期</td><td width="30%">早退日期</td><td width="10%">合计</td></tr>
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
<tr class="df"><td colspan="4">公寓卫生</td></tr>
<tr class="df"><td width="30%">级别</td><td width="30%">日期</td><td  width="30%">得分</td><td width="10%">合计</td></tr>
<?php
if(count($yuanji) > 0)
{	
	$rnow = count($yuanji);
	echo "<tr><td rowspan='$rnow'>院级</td>";
	foreach($yuanji as $k=>$v)
	{
	$datenow = "第".$v->zhouci."周"." ".$v->checkdate;
	if($k == 0)
	echo "<td>$datenow</td><td>$v->score</td><td rowspan='$rnow'>$yuanji_score</td></tr>";
	else
	echo "<td>$datenow</td><td>$v->score</td></tr>";
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
	$datenew = "第".$v->zhouci."周"." ".$v->checkdate;
	if($k == 0)
	echo "<td>$datenew</td><td>$v->score</td><td rowspan='$rnew'>$sch_score</td></tr>";
	else
	echo "<td>$datenew</td><td>$v->score</td></tr>";
	}
}else
{
	echo "<tr><td>校级</td><td colspan='3'>暂无记录</td></tr>";
}
if(count($sushe_star)>0)
{	
	$rnew = count($sushe_star);
	echo "<tr><td rowspan='$rnew'>星级宿舍</td>";
	foreach($sushe_star as $k=>$v)
	{
	$datenew = $v->month."月";
	if($k == 0)
	echo "<td>$datenew</td><td>".$stararr[$v->score]."</td><td rowspan='$rnew'>$star_now</td></tr>";
	else
	echo "<td>$datenew</td><td>".$stararr[$v->score]."</td></tr>";
	}
}else
{
	echo "<tr><td>星级宿舍</td><td colspan='3'>暂无记录</td></tr>";
}
?>
<tr class="df"><td colspan="4">公寓治安</td></tr>
<tr class="df"><td width="30%">违纪类别</td><td width="30%">时间</td><td width="30%">级别</td><td width="10%">合计</td></tr>
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
<tr  class="df"><td colspan="4"><b>违纪处分</b></td></tr>
<tr  class="df"><td width="25%" class='gl'>处分日期</td><td width="25%" class='gl'>类型</td><td width="25%" class='gl'>文件号</td><td width="25%" class='gl'>撤销日期</td></tr>

<?php
 $chufensql = "select * from stu_chufen where name = '$sidarr->name' ";
 $chufendata = $yiqi_db->get_results($chufensql);
if(count($chufendata)>0)
{
 foreach($chufendata as $k=>$v)
 {
	echo "<tr><td>$v->chufendata</td><td>$v->type</td><td>$v->wenjianhao</td><td></td></tr>";
 }
}else
{
 echo "<tr><td colspan='4'>暂无记录</td></tr>";
}
?>
</table>
</td></tr></table>

      	<?php include("footer.php");?>
</body>
</html>
