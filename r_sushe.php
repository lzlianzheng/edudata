<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	
/*
$s_class = $_GET["s_class"];
$s_year = $_GET["s_year"];
$s_major = $_GET["s_major"];
$sql="select b.classid,b.dormbn,b.dormnumber,c.name from student_info b left join class c on b.classid=c.id left join major d on c.majorid = d.id where 1 ";
if($s_class)
	$sql .= " and b.classid='$s_class' ";
$result=$yiqi_db->get_results($sql);
print("$sql");*/

$sql="select b.classid,b.dormbn,b.dormnumber,c.name,c.id,c.majorid,d.id,d.uid from student_info b left join class c on b.classid=c.id left join major d on c.majorid = d.id where 1 ";

include("sqlresult.php");

$classarr = array();
$dormarr = array();
$data = array();
if(count($result) > 0){
foreach($result as $v){
	if(!in_array($v->classid,$classarr)){
		array_push($classarr,$v->classid);
		$data[$v->classid] = array();
		$data[$v->classid]["name"] = $v->name;
		$data[$v->classid]["dlist"] = array();
	}
	if(!in_array($v->classid."__".$v->dormbn,$dormarr)){
		array_push($dormarr,$v->classid."__".$v->dormbn);
		$data[$v->classid]["dlist"][$v->dormbn]	= array();
	}
	if(!in_array($v->dormnumber,$data[$v->classid]["dlist"][$v->dormbn]))
		array_push($data[$v->classid]["dlist"][$v->dormbn],$v->dormnumber);

}
}
if($_GET["act"] == "out"){
	header("Content-type: application/vnd.ms-excel; charset=gb2312");
	Header("Content-Disposition: attachment; filename=sushe.xls");
	$tnow = "<td>班级</td><td>宿舍楼号</td><td>宿舍号</td>";
	echo "<table border=1><tr>".iconv("utf-8","gb2312",$tnow)."</tr>\n";
if(count($data) > 0){
	$outc = "";
	foreach($data as $k=>$v){
		$cnow = count($v["dlist"]);
		$outc .= "<tr><td rowspan='$cnow'>".$v["name"]."</td>";
		if($cnow > 0){
			$i = 0;
			foreach($v['dlist'] as $k1=>$v1){
				if($i == 0)
					$outc .= "<td>$k1</td><td style='vnd.ms-excel.numberformat:@'>".join("，",$v1)."</td></tr>";
				else
					$outc .= "<tr><td>$k1</td><td style='vnd.ms-excel.numberformat:@'>".join("，",$v1)."</td></tr>";
			}
		}else{
			$outc .= "<td>暂无数据</td><td>暂无数据</td></tr>";
		}
	}
	echo iconv("utf-8","gb2312",$outc);
}
	echo "</table>";
}else{
 $title="宿舍分布";
 include("header.php");
?>
<div class="menu tc">
<form action="sushe.php" method="get" class="disin">
<input type="hidden" name="act" value="list">
<?php
	require_once 's_year_class.php';
?>
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>班级</td>
	<td>宿舍楼号</td>
	<td>宿舍号</td>
</tr>
<?php
if(count($data) > 0){
	foreach($data as $k=>$v){
		$cnow = count($v["dlist"]);
		echo "<tr><td rowspan='$cnow'>".$v["name"]."</td>";
		if($cnow > 0){
			$i = 0;
			foreach($v['dlist'] as $k1=>$v1){
				if($i == 0)
					echo "<td>$k1</td><td>".join("，",$v1)."</td></tr>";
				else
					echo "<tr><td>$k1</td><td>".join("，",$v1)."</td></tr>";
			}
		}else{
			echo "<td>暂无数据</td><td>暂无数据</td></tr>";
		}
	}
}
?>
</table>

      	<?php include("footer.php");?>
</body>
</html>
<?php
}
?>
