<?php
require_once 'include/common.inc.php';
	$s_major=$_GET["s_major"];
	$s_year=$_GET["s_year"];
	$s_class=$_GET["s_class"];
	echo "专业 <select name='s_major'><option value=''>请选择</option>";
	$major_sql = "select * from major where uid = 0 ";
	$majorpara=$yiqi_db->get_results($major_sql);
	//$majorpara=globalpara("major");
	
	foreach($majorpara as $v){
		$ckif = ($v->id == $s_major)? "selected" : "" ;
		echo "<option $ckif value='$v->id'>$v->name</option>";
	}
	echo "</select>　　";
	echo "入学年 <select name='s_year'><option value=''>请选择</option>";
	$classyear=$yiqi_db->get_results("select distinct year from class order by year DESC");
		foreach($classyear as $v)
		{	
			$ckif = ($v->year == $s_year)? "selected" : "" ;
			echo "<option $ckif value='$v->year'>$v->year</option>";
		}
	echo "</select>　　";
	$limity=mysql_query("select distinct year from class order by year DESC");
	$limityear = array();
	while( $row = mysql_fetch_assoc($limity) ) $limityear[]=$row;
	//print($limityear[2][year]);
	
	$cpara_sql = "select * from class where 1";
	if($s_year){$cpara_sql .=" and year=$s_year";}
	else
	{	$cpara_sql .=" and year in (";
		for($i=0;$i<=$limitsql;$i++)
		{
			$cpara_sql .=$limityear[$i][year];
			if($i!=$limitsql){$cpara_sql .=",";}
		}
		$cpara_sql .=") ";
	}
	if($s_major){$cpara_sql .=" and majorid=$s_major";}
	$cpara_sql .= " order by name DESC";
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
	echo "</select>";
	//print_r("$cpara_sql");
?>

