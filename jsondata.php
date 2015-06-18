<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	
error_reporting(0);

$type=$_GET["type"];
if($type == "class"){
	$mid = $_GET["mid"];
	$year = $_GET["year"];
	$sql = "select * from class where 1";
	$sql .= ($mid)? " and majorid='$mid'" : "";
//	$sql .= ($year)? " and year='$year'" : "";
			if($year){$sql .=" and year=$year";}
			if(!$year)
			{	
				$limity=mysql_query("select distinct year from class order by year DESC");
				$limityear = array();
				while( $row = mysql_fetch_assoc($limity) ) $limityear[]=$row;
				$sql .=" and year in (";
				for($i=0;$i<=$limitsql;$i++)
				{
					$sql .=$limityear[$i][year];
					if($i!=$limitsql){$sql .=",";}
				}
				$sql .=") ";
			}		
	$sql .= " order by name DESC ";
	$result = $yiqi_db->get_results($sql);
	$major_sql = "select * from major where uid = $uid ";
	$majorpara=$yiqi_db->get_results($major_sql);
	echo "<option value=''>请选择</option>";
	if(count($result > 0))
	{
		foreach($result as $v)
		{
			foreach($majorpara as $j)
			{
				if($v->majorid == $j->id )
				{
					echo "<option value='$v->id'>$v->name</option>";
				}
			}
		}
	}
}
/*
if($type == "stu"){
	$mid = $_GET["mid"];
	$sql = "select * from class where 1";
	$sql .= ($mid)? " and majorid='$mid'" : "";
	$result = $yiqi_db->get_results($sql);
	echo "<option value=''>全部</option>";
	if(count($result > 0)){
		foreach($result as $v){
			echo "<option value='$v->name'>$v->name</option>";
		}
	}
}*/
if($type == "org"){
	$cid = $_GET["org_class"];
	$sql = "select  * from org_style_d where cid = $cid ";
	$result = $yiqi_db->get_results($sql);
	//ShowMsg("$org_cid","back");
	echo "<option value=''>请选择</option>";
	if(count($result)>0){
		foreach($result as $v){
			echo "<option value='$v->id'>$v->name</option>";
		}
	}
}
?>
