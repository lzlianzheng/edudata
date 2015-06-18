<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	
error_reporting(0);
$action = $_POST['action'];
$name = $_GET['name'];
if($action=='out')
{
	$keyarr = $_POST["keylist"];
	$start = ((int)$_POST["start"]) - 1;
	$end = (int)$_POST["end"];
	if($start < 0 || $end < 1 || $start >= $end)
		ExitMsg("请输入正确的起止行数。","back");
	$keylist = "";
	if(count($keyarr) > 0){
		$tablename = $edukey['table_name'][$name];
		$where = "";
		foreach($keyarr as $v){
			$keylist .= ($keylist)? ",a.$v " : "a.$v " ;
		}
		$tablename .= " a";
		$classsum = 0;
		if($name == "student"){
			$tablename .= (strpos($keylist,"classid") > 0)? " left join class b on a.classid=b.id " : "";
			$tablename .= (strpos($keylist,"nationid") > 0)? " left join nation c on a.nationid=c.id " : "";
			$keylist = str_replace("a.classid","b.name as class",$keylist);
			$keylist = str_replace("a.nationid","c.name as nation",$keylist);
			$w .= ($_POST['s_major'])? " and majorid='".$_POST['s_major']."' " : "";
			$w .= ($_POST['s_year'])? " and year='".$_POST['s_year']."' " : "";
			$w .= ($_POST['s_class'])? " and classid='".$_POST['s_class']."' " : "";
			$where .= " and a.classid in (select id from class where 1 $w) ";
		}else if($name == "class"){
			$tablename .= (strpos($keylist,"d_mobile1") > 0)?" left join cteacher b on a.deanteacher=b.name " : "";
			$keylist = str_replace("a.d_mobile1","b.mobile as m1",$keylist);
			$tablename .= (strpos($keylist,"m_mobile2") > 0)?" left join student_info c on a.monitor=c.name " : "";
			$keylist = str_replace("a.m_mobile2","c.mobilephone as m2",$keylist);
			if(strpos($keylist,"c_sum") > 0){
				$classsum = 1;
				$keylist = str_replace(",a.c_sum","",$keylist);
				$keylist = str_replace("a.c_sum","",$keylist);
			}
		}else if($name == "xueshenghui"){
			$where .= ($_POST['jieci'])? " and a.jieci='".$_POST['jieci']."' " : "";
		}
		$sql = "select $keylist from $tablename where 1 $where limit $start,".($end-$start);
		//exit($sql);
		$result = $yiqi_db->get_results($sql);
		#print_r($result);
		function replace_special_char($str)
		{
   	 $str = str_replace("\r\n", "　", $str);
   	 $str = str_replace("\t", "    ", $str);
   	 $str = str_replace("\n", "　", $str);
		 $str = str_replace(",", "，", $str);
		 $str = "<td style='vnd.ms-excel.numberformat:@'>$str</td>";
   	 return $str;
		}
		header("Content-type: application/vnd.ms-excel; charset=gb2312");
		Header("Content-Disposition: attachment; filename=".$name.".xls");
		$tnow = "";
		foreach($keyarr as $v){
			$tnow .= "<td>".$edukey[$name][$v]."</td>";
		}
		if($classsum == 1)
			$tnow = str_replace("<td>人数统计</td>","<td>男生</td><td>女生</td><td>总数</td><td>插班生</td><td>民族生</td>",$tnow);
		echo "<table><tr>".iconv("utf-8","utf-8",$tnow)."</tr>\n";

		foreach($result as $v)
		{
			$exarr = array();
			foreach($v as $x){
				array_push($exarr,replace_special_char($x));
			}
			if($classsum == 1){
				$csex = $yiqi_db->get_results("select count(sid) as c ,sex from student_info where classid='$v->id' group by sex order by sex");
				$c_female = $csex[0]->c;
				$c_male = $csex[1]->c;
				$c_total = $c_female + $c_male;
				$chaban_s = $yiqi_db->get_row("select count(sid) as c from student_info where type='插班生' and classid='$v->id'");
				$nation_s = $yiqi_db->get_row("select count(sid) as c from student_info where nationid!='1' and classid='$v->id'");
				array_push($exarr,replace_special_char($c_male));
				array_push($exarr,replace_special_char($c_female));
				array_push($exarr,replace_special_char($c_total));
				array_push($exarr,replace_special_char($chaban_s->c));
				array_push($exarr,replace_special_char($nation_s->c));
			}
			echo "<tr>".iconv("utf-8","utf-8",join("\n", $exarr)). "</tr>\n";
		}
		echo "</table>";
	}else{
		ExitMsg("至少要选择一个导出字段。","back");
	}
}else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>导出数据</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="images/main.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="images/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="images/motion.js"></script>
</head>
<body>
<div class="wrap">
<div class="header"></div>
 	<div class="nav">
        <span class="fr">
          <?php include("head_nav.php");?>
        </span>
      </div>
<div class="mainbody">
 <div id="main_nav">
          <?php include("leftnav.php");?>
          <script type="text/javascript" src="./managerindex/ddaccordion.js">
          </script>
          <script type="text/javascript">
            ddaccordion.init({
              headerclass: "submenuheader",
              contentclass: "submenu",
              revealtype: "click",
              mouseoverdelay: 200,
              collapseprev: true,
              defaultexpanded: [],
              onemustopen: false,
              animatedefault: false,
              persiststate: true,
              toggleclass: ["", ""],
              togglehtml: ["suffix", "", ""],
              animatespeed: "fast",
              oninit: function(headers, expandedindices) {
                //do nothing
              },
              onopenclose: function(header, index, state, isuseractivated) {
                //do nothing
              }
            });
          </script>
          <style type="text/css">
            .submenu{display: none}
          </style>
        </div>
	<div class="mainc">
<form id="data" action="" method="post"> 
<input type="hidden" name="action" value="out" />
<table border=0 cellpadding=0 cellspacing=0 class="t_list tl list5">
	<tr><th>导出数据</th><th><a href="<?php echo $name; ?>.php">返回列表</a></th></tr>
	<tr>
		<td width="100">选择导出字段<br/><label><input type='checkbox' id='checkall' checked /> 全部</label></td>
		<td>
<?php
foreach($edukey[$name] as $k => $v){
	echo "<label><input type='checkbox' name='keylist[]' value='$k' checked > $v</label>";
}
?>
		</td>
	</tr>
	<tr>
		<td>导出行数</td><td>起始：<input type="number" name="start" value="1" />　　结束：<input type="number" name="end" value="1400" />　　<span>友情提示：为防止出错，每次导出数据请不要超过1000行</span></td>
	</tr>
<?php
if($name=="student"){
	echo "<tr><td>过滤条件</td><td>";

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
	姓名<input type="text" name="sname">
	学号<input type="text" name="sid">
	<input type="submit" value="查询" id="submit" />
<?php
	echo "</td></tr>";
}else if($name=="xueshenghui"){
	echo "<tr><td>过滤条件</td><td>";
	echo "届次 <select name='s_major'><option value=''>请选择</option>";
	$jiecidata = $yiqi_db->get_results("select distinct jieci from xueshenghui");
	foreach($jiecidata as $v){
		echo "<option value='$v->jieci'>$v->jieci</option>";
	}
	echo "</select>　　　";
	echo "</td></tr>";
}
?>
	<tr>
		<td></td><td><input type="submit" value=" 提 交 " /></td>
	</tr>
</table>
</form>
</div>
</div>
  <div class="clear">
        &nbsp;
      </div>
 <div class="footer">
      	<?php include("footer.php");?>
      </div> 
</div>
</body>
</html>
<?php
}
?>
