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
	$sql = "select a.kuangcaodate,a.chidaodate,a.burenzhendate,b.kuangkedate,b.chidaodate,b.zaotuidate,c.absentriqi,d.dormzhian from zaocao_personal a left join wanzixi_personal b on a.sid =b.sid and a.xueqi = b.xueqi left join stu_absent_record c on a.sid = c.sid and a.xueqi = c.xueqi left join dormzhian d 
	on a.sid = d.sid and a.xueqi = d.xueqi";
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