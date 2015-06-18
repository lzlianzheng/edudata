<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';
$curpage = $_GET["p"];
$curpage = (isset($curpage) && is_numeric($curpage)) ? $curpage : 1;
if($curpage<1)
	$curpage=1;

if($_GET["act"] == "display" || $_GET["act"] == "out")
{
	$username = $_GET["sname"];
	$xuehao = $_GET["sid"];
	$year = $_GET["xuenian"];
	$xueqi = $_GET["xueqi"];
	$zhouci = $_GET["zhouci"];
	$mid = $_REQUEST['s_major'];
	$grade=$_GET["s_year"];
	$class = $_REQUEST['s_class'];
	if($year && $xueqi)
	{
		$data = array();
		$max_zhouci = 0;
		$sql = "select a.*,b.majorid,b.year,b.name as classname,d.id,d.uid from student_info a left join class b on a.classid = b.id left join major d on b.majorid = d.id where 1 and a.status='在读' ";
		$sql .=" and d.uid = $uid "; 
		if($mid)
		$sql .= " and b.majorid = '$mid'";
		if($grade)
		$sql .=" and b.year=$grade";
		if($class)
		$sql .=" and a.classid = '$class'";
		if($username)
		$sql .=" and a.name = '$username'";
		if($xuehao)
		$sql .=" and a.sid = '$xuehao'";
		$stu = $yiqi_db->get_results($sql);
		$jishu=0;
		foreach($stu as $k=>$v)
		{
		 	$jishu++;
			$score = 60;
			$stuid = $v->sid;
			$dormlou = $v->dormbn;
			$dormnum = $v->dormnumber;
			$classname = $v->classname;
			$sid = $v->sid;
			$name = $v->name;
			$absent_zhouci = $yiqi_db->get_row("select max(zhouci) as zhouci from stu_absent_record");
			$max_absent = $absent_zhouci->zhouci;
			$max_zhouci = ($max_zhouci >= $max_absent)? $max_zhouci : $max_absent;
			$sql = "select * from stu_absent_record where sid = '$stuid' and year = '$year' and xueqi = '$xueqi'";
			$sql .=($zhouci)? " and zhouci <= $zhouci":" and zhouci <= $max_absent";
			//echo $sql;
			$kuangke = $yiqi_db->get_results($sql);
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
			$zaocao_zhouci = $yiqi_db->get_row("select max(zhouci) as zhouci from zaocao_personal");
			$max_zaocao = $zaocao_zhouci->zhouci;
			$max_zhouci = ($max_zhouci >= $max_zaocao)? $max_zhouci : $max_zaocao;
			$sql1 = "select * from zaocao_personal where sid='$stuid' and year = '$year' and xueqi = '$xueqi'";
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
			$max_zhouci = ($max_zhouci >= $max_wanzixi)? $max_zhouci : $max_wanzixi;
			$sql2 = "select * from wanzixi_personal where sid = '$stuid' and year = '$year' and xueqi = '$xueqi'";
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
			$zhian_zhouci = $yiqi_db->get_row("select max(zhouci) as zhouci from dormzhian");
			$max_zhian = $zhian_zhouci->zhouci;
			$max_zhouci = ($max_zhouci >= $max_zhian)? $max_zhouci : $max_zhian;
			$sql5 = "select * from dormzhian where sid='$stuid' and year = '$year' and xueqi = '$xueqi'";
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
			$yuanji_zhouci = $yiqi_db->get_row("select max(zhouci) as zhouci from weisheng_yuanji");
			$max_yuan = $yuanji_zhouci->zhouci;
			$max_zhouci = ($max_zhouci >= $max_yuan)? $max_zhouci : $max_yuan;
			$sql4 = "select * from weisheng_yuanji where year = '$year' and xueqi = '$xueqi' and  dormlou = '$dormlou' and dormnum = '$dormnum'";
			$sql4 .=($zhouci)? " and zhouci <= $zhouci":" and zhouci <= $max_yuan";
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
			$sch_zhouci = $yiqi_db->get_row("select max(zhouci) as zhouci from weisheng_sch");
			$max_sch = $sch_zhouci->zhouci;
			$max_zhouci = ($max_zhouci >= $max_sch)? $max_zhouci : $max_sch;
			$sql6 = "select * from weisheng_sch where year = '$year' and xueqi = '$xueqi' and  dormlou = '$dormlou' and dormnum = '$dormnum'";
			$sql6 .=($zhouci)? " and zhouci <= $zhouci":" and zhouci <= $max_sch";
			
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
		$sql7 = "select * from sushe_star where year = '$year' and xueqi = '$xueqi' and  dormlou = '$dormlou' and dormnum = '$dormnum'";
		$sushe_star = $yiqi_db->get_results($sql7);
		if(count($sushe_star) > 0){
			$star_now = 0;
			foreach($sushe_star as $v){
				$star_now += $star_score[$v->score];
			}
			$score += $star_now;
		}
			$e_zhouci = ($zhouci) ? ($zhouci) : ($max_zhouci);
			array_push($data,array('classname'=>$classname,'sid'=>$sid,'name'=>$name,'year'=>$year,'xueqi'=>$xueqi,'zhouci'=>$e_zhouci,'e_score'=>$score));
		}
	}else
	{
	ShowMsg("请选择学年/学期","back");
	
	}
	
}
if($_GET["act"] == "out")
{
	header("Content-type: application/vnd.ms-excel; charset=gb2312");
	Header("Content-Disposition: attachment; filename=check_score.xls");
	$tnow = "<td>班级</td><td>学号</td><td>姓名</td><td>学年</td><td>学期</td><td>截止周次</td><td>得分</td>";
	echo "<table border=1><tr>".$tnow."</tr>\n";
	if(count($data) > 0)
	{
		$outc = '';
		foreach($data as $k=>$v)
		{		
			$outc .= "<tr><td>$v[classname]</td><td>$v[sid]</td><td>$v[name]</td><td>$v[year]</td><td>$v[xueqi]</td><td>$v[zhouci]</td><td>$v[e_score]</td></tr>";			
		}
		echo $outc;
	}
	echo "</table>";
}else{
$title="日常考核汇总";
include("header.php");

$total = (int)$jishu;
$take = 50;
$totalpage = (int)($total % $take == 0 ? $total / $take : $total / $take + 1);
$curpage = ($totalpage == 0)? 1 : (($curpage > $totalpage)? $totalpage : $curpage) ;
$skip = ($curpage - 1) * $take;
//$result = $yiqi_db->get_results($sql . $orderby . " limit $skip,$take ");
//print_r($result);
//$majorpara = globalpara("major");
$url = "check_score.php?act=display&s_major=$mid&s_class=$classid&year=$year&xueqi=$xueqi&zhouci=$zhouci&username=$username&xuehao=$xuehao&";
$pagerhtml = pager($totalpage,$curpage,$url);
?>
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
<div class="menu tc">

<a href="<?php echo "check_score.php?act=out&s_major=$mid&s_class=$class&year=$year&xueqi=$xueqi&zhouci=$zhouci&username=$username&xuehao=$xuehao"; ?>">导出数据</a><br/>	
<form action="check_score.php" method="get" class="disin">
	<input type="hidden" name="act" value="display">
	周次<input name="zhouci" value="<?php  echo $zhouci;?>" size="5">
<?php
	require_once 's_year_class.php';
	require_once 's_name_sid.php';
	require_once 's_xuenian(qi).php';
?>
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>班级</td>
	<td>学号</td>
	<td>姓名</td>
	<td>学年</td>
	<td>学期</td>
	<td>截止周次</td>
	<td>得分</td>
</tr>
<?php
if(count($data) > 0)
{
	foreach($data as $k=>$v)
	{
	
		echo "<tr><td>$v[classname]</td><td>$v[sid]</td><td>$v[name]</td><td>$v[year]</td><td>$v[xueqi]</td><td>$v[zhouci]</td><td>$v[e_score]</td></tr>";
		
	}
}else
	echo "<tr><td colspan='7'>暂无数据</td></tr>"; 
?>
</table>

      <center>	<?php 
      	  if($totalpage > 1)
			 {	
				echo '<div class="pager">总计 '.$total.' 条记录，每页 '.$take.' 条，共 '.$totalpage.' 页。　　　　　到第<input type="text" id="pagego" />页 <input type="button" value=" GO " id="pagego_do" />　'.$pagerhtml.'</div>';
			 }
      	 include("footer.php");
      	 ?>
     </center>
</body>
</html>
<?php
}
?>
