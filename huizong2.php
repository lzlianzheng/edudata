<?php
require_once 'include/common.inc.php';
$sql="select * from class ";
$res=$yiqi_db->get_results($sql);
$data=array();
foreach($res as $v)
{
	$tename="";
	$yiname="";
	$ername="";
	$sanname="";
	$hon1="";
	$hon2="";
	$classname=$v->name;
	$sql1="select name from scholarship where class='$classname' and scholarship like'特等%'";
	$tedeng=$yiqi_db->get_results($sql1);
	$tedeng_sum+=count($tedeng);
	$sql2="select name from scholarship where class='$classname' and scholarship like '一等%'";
	$yideng=$yiqi_db->get_results($sql2);
	$yideng_sum+=count($yideng);
	$sql3="select name from scholarship where class='$classname' and scholarship like '二等%'";
	$erdeng=$yiqi_db->get_results($sql3);
	$erdeng_sum+=count($erdeng);
	$sql4="select name from scholarship where class='$classname' and scholarship like '三等%'";
	$sandeng=$yiqi_db->get_results($sql4);
	$sandeng_sum+=count($sandeng);
	$sql5="select name from stuhonour where class='$classname' and jibie = '校级' and honourname='三好学生'";
	$honour1=$yiqi_db->get_results($sql5);
	$sanhao_sum+=count($honour1);
	$sql6="select name from stuhonour where class='$classname' and jibie = '校级' and honourname='优秀学生干部'";
	$honour2=$yiqi_db->get_results($sql6);
	$yougan_sum+=count($honour2);
	if(count($tedeng)>0)
	{ 
	foreach($tedeng as $v)
	$tename.=$v->name."、";
	}
	if(count($yideng)>0)
	{ 
	foreach($yideng as $v)
	$yiname.=$v->name."、";
	}
	if(count($erdeng)>0)
	{ 
	foreach($erdeng as $v)
	$ername.=$v->name."、";
	}
	if(count($sandeng)>0)
	{ 
	foreach($sandeng as $v)
	$sanname.=$v->name."、";
	}
	if(count($honour1)>0)
	{ 
	foreach($honour1 as $v)
	$hon1.=$v->name."、";
	}
	if(count($honour2)>0)
	{ 
	foreach($honour2 as $v)
	$hon2.=$v->name."、";
	}
	
	array_push($data,array("classname"=>$classname,"te"=>$tename,"yi"=>$yiname,"er"=>$ername,"san"=>$sanname,"sanhao"=>$hon1,"yougan"=>$hon2));
}
if($_GET["act"] == "out"){
	header("Content-type: application/vnd.ms-excel; charset=gb2312");
	Header("Content-Disposition: attachment; filename=huizong.xls");
	$tnow = "<td>班级</td><td>特等奖</td><td>一等奖</td><td>二等奖</td><td>三等奖</td><td>校三好</td><td>校优干</td>";
	echo "<table border=1><tr>".$tnow."</tr>\n";
	if(count($data) > 0){
	$outc="";
		foreach($data as $k=>$v){
			$outc .= "<tr>";
				$outc .= "<td>".$v['classname']."</td>";
				$outc .= "<td>".$v['te']."</td>";
				$outc .= "<td>".$v['yi']."</td>";
				$outc .= "<td>".$v['er']."</td>";
				$outc .= "<td>".$v['san']."</td>";
				$outc .= "<td>".$v['sanhao']."</td>";
				$outc .= "<td>".$v['yougan']."</td>";
				$outc .= "</tr>";
		}
		//echo iconv("utf-8","gb2312",$outc);
		echo $outc;
	}
	$heji .="<tr><td>合计</td><td>$tedeng_sum</td>
	<td>$yideng_sum</td>
	<td>$erdeng_sum</td>
	<td>$sandeng_sum</td>
	<td>$sanhao_sum</td>
	<td>$yougan_sum</td>
	</tr>";
	echo $heji;
	echo  "</table>";
}
else{
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
<a href="list.php">返回</a>
<a href="<?php echo "huizong.php?act=out"; ?>">导出数据</a>　　<br/>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list2">
<tr>
	<td width=80>班级</td>
	<td width=60>特等奖</td>
	<td width=50>一等奖</td>
	<td width=150>二等奖</td>
	<td width=110>三等奖</td>
	<td width=50>校三好</td>
	<td width=50>校优干</td>
</tr>
<?php
if(count($data) > 0){
	foreach($data as $k=>$v){
		echo "<tr>";
			echo "<td>".$v['classname']."</td>";
			echo "<td>".$v['te']."</td>";
			echo "<td>".$v['yi']."</td>";
			echo "<td>".$v['er']."</td>";
			echo "<td>".$v['san']."</td>";
			echo "<td>".$v['sanhao']."</td>";
			echo "<td>".$v['yougan']."</td>";
		    echo "</tr>";
	}
}

?>
<tr>
<td>合计</td>
<td><?php echo $tedeng_sum;?></td>
<td><?php echo $yideng_sum;?></td>
<td><?php echo $erdeng_sum;?></td>
<td><?php echo $sandeng_sum;?></td>
<td><?php echo $sanhao_sum;?></td>
<td><?php echo $yougan_sum;?></td>
</tr>
</table>
</div>
</body>
</html>
<?php
}
?>
