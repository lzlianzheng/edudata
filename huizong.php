<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	
if($_GET['act'] == "sel" || $_GET["act"] == "out")
{
$s_major=$_GET["s_major"];
$s_class = $_GET["s_class"];
$s_year = $_GET["s_year"];
$xueqi = $_GET["xueqi"];
$year = $_GET["xuenian"];

$sql="select a.*,a.id,a.majorid from class a left join major b on a.majorid = b.id where 1";
$sql .=" and b.uid = $uid "; 
$sql .= ($s_year)? " and a.year='$s_year' " : "";
$sql .= ($s_major)? " and a.majorid='$s_major' " : "";
$sql .= ($s_class)? " and a.id=$s_class" : "" ;

$classdatanow=$yiqi_db->get_results($sql);

$classparanow=globalpara("class");
$data=array();
foreach($classdatanow as $v){
	$cid = $v->id;
	$classname = $classparanow[$cid];
	$tename="";
	$yiname="";
	$ername="";
	$sanname="";
	$hon1="";
	$hon2="";
	$totalnumber="";
	$sql1="select b.name from scholarship a left join student_info b on a.sid=b.sid where b.classid='$cid' and a.scholarship like'特等%'";
	$sql2="select b.name from scholarship a left join student_info b on a.sid=b.sid where b.classid='$cid' and a.scholarship like'一等%'";
	$sql3="select b.name from scholarship a left join student_info b on a.sid=b.sid where b.classid='$cid' and a.scholarship like'二等%'";
	$sql4="select b.name from scholarship a left join student_info b on a.sid=b.sid where b.classid='$cid' and a.scholarship like'三等%'";
	$sql5="select b.name from stuhonour a left join student_info b on a.sid=b.sid where b.classid='$cid' and a.jibie='校级' and honourname='三好学生'";
	$sql6="select b.name from stuhonour a left join student_info b on a.sid=b.sid where b.classid='$cid' and a.jibie='校级' and honourname='优秀学生干部'";	
	$sql7="select * from `student_info` where type!='插班生' and status='在读' and classid='$cid'";

	if($xueqi)
	{
	$sql1 .=" and a.xueqi=$xueqi";
	$sql2 .=" and a.xueqi=$xueqi";
	$sql3 .=" and a.xueqi=$xueqi";
	$sql4 .=" and a.xueqi=$xueqi";
	$sql5 .=" and a.xueqi=$xueqi";
	$sql6 .=" and a.xueqi=$xueqi";
	}
	if($year)
	{
	$sql1 .=" and a.year='$year'";
	$sql2 .=" and a.year='$year'";
	$sql3 .=" and a.year='$year'";
	$sql4 .=" and a.year='$year'";
	$sql5 .=" and a.year='$year'";
	$sql6 .=" and a.year='$year'";
	}
	$tedeng=$yiqi_db->get_results($sql1);
	$tedeng_sum+=count($tedeng);
	
	$yideng=$yiqi_db->get_results($sql2);
	$yideng_sum+=count($yideng);
	
	$erdeng=$yiqi_db->get_results($sql3);
	$erdeng_sum+=count($erdeng);
	
	$sandeng=$yiqi_db->get_results($sql4);
	$sandeng_sum+=count($sandeng);
	
	$honour1=$yiqi_db->get_results($sql5);
	$sanhao_sum+=count($honour1);
	
	$honour2=$yiqi_db->get_results($sql6);
	$yougan_sum+=count($honour2);
	
	$ttnumber=$yiqi_db->get_results($sql7);
	$totalnumber=count($ttnumber);
	$total_sum+=count($ttnumber);
	//
	if(count($tedeng)>0)
	{ 
	for($i=0,$length=count($tedeng);$i<$length;$i++)
	{
	 if($i<$length-1)
	  $tename.=$tedeng[$i]->name."、";
	 else
	  $tename.=$tedeng[$i]->name;
	}
	}
	if(count($yideng)>0)
	{ 
	for($i=0,$length=count($yideng);$i<$length;$i++)
	{
	 if($i<$length-1)
	  $yiname.=$yideng[$i]->name."、";
	 else
	  $yiname.=$yideng[$i]->name;
	}
	}
	if(count($erdeng)>0)
	{ 
	 for($i=0,$length=count($erdeng);$i<$length;$i++)
	{
	 if($i<$length-1)
	  $ername.=$erdeng[$i]->name."、";
	 else
	  $ername.=$erdeng[$i]->name;
	}
	}
	if(count($sandeng)>0)
	{ 
	 for($i=0,$length=count($sandeng);$i<$length;$i++)
	{
	 if($i<$length-1)
	  $sanname.=$sandeng[$i]->name."、";
	 else
	  $sanname.=$sandeng[$i]->name;
	}
	}
	if(count($honour1)>0)
	{ 
	 for($i=0,$length=count($honour1);$i<$length;$i++)
	{
	 if($i<$length-1)
	  $hon1.=$honour1[$i]->name."、";
	 else
	  $hon1.=$honour1[$i]->name;
	}
	}
	if(count($honour2)>0)
	{ 
	for($i=0,$length=count($honour2);$i<$length;$i++)
	{
	 if($i<$length-1)
	  $hon2.=$honour2[$i]->name."、";
	 else
	  $hon2.=$honour2[$i]->name;
	}
	}
	array_push($data,array("classname"=>$classname,"total"=>$totalnumber,"te"=>$tename,"yi"=>$yiname,"er"=>$ername,"san"=>$sanname,"sanhao"=>$hon1,"yougan"=>$hon2));
}
}
if($_GET["act"] == "out"){
	header("Content-type: application/vnd.ms-excel; charset=gb2312");
	Header("Content-Disposition: attachment; filename=huizong.xls");
	$tnow = "<td>班级</td><td>总人数</td><td>特等奖</td><td>一等奖</td><td>二等奖</td><td>三等奖</td><td>校三好</td><td>校优干</td>";
	echo "<table border=1><tr>".$tnow."</tr>\n";
	if(count($data) > 0){
	$outc="";
		foreach($data as $k=>$v){
			$outc .= "<tr>";		
				$outc .= "<td>".$v['classname']."</td>";
				$outc .="<td>".$v['total']."</td>";
				$outc .= "<td>".$v['te']."</td>";
				$outc .= "<td>".$v['yi']."</td>";
				$outc .= "<td>".$v['er']."</td>";
				$outc .= "<td>".$v['san']."</td>";
				$outc .= "<td>".$v['sanhao']."</td>";
				$outc .= "<td>".$v['yougan']."</td>";
				$outc .= "</tr>";
		}
		echo $outc;
	}
	$heji .="<tr><td>合计</td><td>$total_sum</td>
	<td>$tedeng_sum</td>
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
 $title="荣誉汇总";
 include("header.php");
?>
          
<div class="menu">
<a href="<?php echo "huizong.php?act=out&s_year=$s_year&s_major=$s_major&s_class=$s_class&xuenian=$year&xueqi=$xueqi"; ?>">导出数据</a>　　<br/>
<form action="huizong.php" method="get" class="disin">
<input type="hidden" name="act" value="sel">
<?php
//require_once 'include/common.inc.php';
	$s_major=$_GET["s_major"];
	$s_year=$_GET["s_year"];
	$s_class=$_GET["s_class"];
	$xuenian=$_GET["xuenian"];
	$xueqi=$_GET["xueqi"];
	echo "专业 <select name='s_major'><option value=''>请选择</option>";
	$major_sql = "select * from major where uid = $uid ";
	$majorpara=$yiqi_db->get_results($major_sql);
	//$majorpara=globalpara("major");
	
	foreach($majorpara as $v){
		$ckif = ($v->id == $s_major)? "selected" : "" ;
		echo "<option $ckif value='$v->id'>$v->name</option>";
	}
	echo "</select>　　";
	echo "入学年 <select name='s_year'><option value=''>请选择</option>";
	$classyear=$yiqi_db->get_results("select distinct year from class order by year");
		foreach($classyear as $v)
		{
			$ckif = ($v->year == $s_year)? "selected" : "" ;
			echo "<option $ckif value='$v->year'>$v->year</option>";
		}
	echo "</select>　　";
	//print("$s_year");
	//echo "班级 <select name='s_class'><option value=''>请选择</option>";
	
	$cpara_sql = "select * from class where 1";
	if($s_year){$cpara_sql .=" and year=$s_year";}
	if($s_major){$cpara_sql .=" and majorid=$s_major";}
	//$cpara_sql .= ($s_year)? " and year='$s_year'";
	//$cpara_sql .= ($s_major)? " and majorid='$s_major'";
	$cpara_sql .= " order by name";
	//$classpara=array();

	$classdata=$yiqi_db->get_results($cpara_sql);
	echo "班级 <select name='s_class'><option value=''>请选择</option>";
		foreach($classdata as $v)
		{
			//$classpara[$v->id] = $v->name;
			foreach($majorpara as $j)
			{
				if($v->majorid == $j->id )
				{
					$ckif = ($v->id == $s_class)? "selected" : "" ;
					echo "<option $ckif value='$v->id'>$v->name</option>";
				}
			}
		}
	echo "</select>　　";
?>
	所属学年<select name='xuenian'><option value=''>请选择</option>
<?php
	foreach($yeardata as $v){
		$se = ($v == "$xuenian")? " selected " : "";
		echo "<option $se value=$v>$v</option>";
	}
?>
	</select>
	学期<select name='xueqi'><option value=''>请选择</option>
		<option <?php if($xueqi==1){echo "selected";} ?> value="1">第一学期</option>
		<option <?php if($xueqi==2){echo "selected";} ?> value="2">第二学期</option>
	</select>
		<input type="submit" value="查询" id="submit" />
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td width=80>班级</td>
	<td width=60>总人数</td>
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
			echo "<td>".$v['total']."</td>";;
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
<td><?php echo $total_sum; ?></td>
<td><?php echo $tedeng_sum;?></td>
<td><?php echo $yideng_sum;?></td>
<td><?php echo $erdeng_sum;?></td>
<td><?php echo $sandeng_sum;?></td>
<td><?php echo $sanhao_sum;?></td>
<td><?php echo $yougan_sum;?></td>
</tr>
</table>
      	<?php include("footer.php");?>
</body>
</html>
<?php
}
?>
