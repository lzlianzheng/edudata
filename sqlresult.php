<?php	
	require_once 'include/common.inc.php';
	require_once 'include/common.func.php';
	$limity=mysql_query("select distinct year from class order by year DESC");
	$limityear = array();
	while( $row = mysql_fetch_assoc($limity) ) $limityear[]=$row;
	if($_REQUEST['act'] =='list' || $_REQUEST["act"] == "out")
	{	
		$sname = $_GET["sname"];
		$sid = $_GET["sid"];
		$major=$_GET["s_major"];
		$grade=$_GET["s_year"];
		$classn = $_GET["s_class"];
		$sxuenian = $_GET["xuenian"];
		$sxueqi = $_GET["xueqi"];
		$zhouci = $_GET["zhouci"];
		$month = $_GET["month"];
		//$sql = $_REQUEST["sql"];
				$sql .=" and d.uid = $uid "; 
			if($major)
				$sql .=" and c.majorid=$major";	
			if($sxuenian)
			{
				if($table == sbisai_prize){$sql .=" and a.prizeyear='$sxuenian'";}
				elseif($panduan == 1){$sql .=" and a.xuenian='$sxuenian'";}
				else{$sql .=" and a.year='$sxuenian'";}
			}
			if($month)
				$sql .=" and a.month=$month";			
			if($zhouci)
				$sql .=" and a.zhouci=$zhouci";
			if($sxueqi)
				$sql .=" and a.xueqi=$sxueqi";
			if($classn)
				$sql .=" and c.id=$classn";
			if($sname)
				$sql .=" and b.name like '%$sname%' "; 
			if($sid)
				$sql .=" and b.sid=$sid";
			if($grade){$sql .=" and c.year = $grade ";}
			if(!$grade)
			{	$sql .=" and c.year in (";
				for($i=0;$i<=$limitsql;$i++)
				{
					$sql .=$limityear[$i][year];
					if($i!=$limitsql){$sql .=",";}
				}
				$sql .=") ";
			}	
			
		$result=$yiqi_db->get_results($sql);
		//print("$sql");
	}
	if($_REQUEST['act']=='delete')
	{
		$id = $_GET["id"];
		$sql="delete from $table where id=$id";
		$result=$yiqi_db->query($sql);
		if($result==1)
			ShowMsg("删除成功","back");
		else
			ShowMsg("$sql","back");
	}
	$actstat = $_POST["stat"];
	if($actstat)
	{
		$idarr = $_POST["chk"];
		if(count($idarr) > 0)
		{
			foreach($idarr as $id)
			{
				if(is_numeric($id))
				{
					$sql = "DELETE FROM $table WHERE id = $id";
					$yiqi_db->query(CheckSql($sql));
				}
			}
		ShowMsg("指定用户删除成功");
		}
	}

?>
