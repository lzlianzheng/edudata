<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	
$monthdata = $yiqi_db->get_results("select distinct month from sushe_star order by month ASC");
//$yeardata = $yiqi_db->get_results("select distinct year from sushe_star");
$stararr = array("","一星","二星","三星","四星","五星");
$xueqiarr = array("","第一学期","第二学期");
	$table = sushe_star;
	$sql = "select a.id as nid,a.dormlou,a.dormnum,a.score,a.month,a.year as xuenian,a.xueqi,a.recorder,c.id as classid,c.name as classname,d.id,d.uid  from sushe_star a left join class c on a.class = c.id left join major d on c.majorid = d.id where 1";
	include("sqlresult.php");
/*if($_REQUEST['act'] == 'stat' || $_REQUEST['act'] == 'out')
{	
	$scorearr = array();
	$c_score = array();
	$s_major = $_GET["s_major"];
	$s_class = $_GET["s_class"];
	$year = $_GET["xuenian"];
	$xueqi = $_GET["xueqi"];
	$month = $_GET["month"];
		$sql = "select a.id as nid,a.dormlou,a.dormnum,a.score,a.month,a.year as xuenian,a.xueqi,a.recorder,c.id as classid,c.name as classname,d.id,d.uid  from sushe_star a left join class c on a.class = c.id left join major d on c.majorid = d.id where 1";
			$sql .=" and d.uid = $uid "; 
		if($s_major)
		$sql .= " and c.majorid = $s_major";
		if($s_class)
		$sql .= " and c.id = $s_class";
		if($year)
		$sql .= " and a.year = '$year'";
		if($xueqi)
		$sql .= " and a.xueqi = $xueqi";
		if($month)
		$sql .= " and a.month = $month";
		$result=$yiqi_db->get_results($sql);
		$classarr = array();
		foreach($result as $k=>$v)
		{
			$record = array("id"=>$v->id,"dormlou"=>$v->dormlou,"dormnum"=>$v->dormnum,"year"=>$v->year,"xueqi"=>$xueqiarr[$v->xueqi],"month"=>$v->month,"score"=>$stararr[$v->score],"recorder"=>$v->recorder);
			if(!in_array($v->classname,$classarr))
			{
				array_push($classarr,$v->classname);
				$data[$v->classname] = array();
				array_push($data[$v->classname],$record);				
			}else{
				array_push($data[$v->classname],$record);	
			}
		}

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
					$sql = "DELETE FROM sushe_star where id = $id";
					$yiqi_db->query(CheckSql($sql));
				}
			}
		ShowMsg("指定用户删除成功");
		}
	}*/
if($_GET["act"] == "out")
{
	header("Content-type: application/vnd.ms-excel; charset=gb2312");
	Header("Content-Disposition: attachment; filename=weisheng_sch_score.xls");
	$tnow = "<td>班级</td><td>宿舍楼</td><td>宿舍号</td><td>学年</td><td>学期</td><td>月份</td><td>星级</td><td>记录人</td>";
	echo "<table border=1><tr>".$tnow."</tr>\n";
	if(count($data) > 0){
			$outc = "";
			foreach($data as $k=>$v)
			{
				$num = count($v);
				$outc .= "<tr>";
				$outc .= "<td rowspan='$num'>$k</td>";
				foreach($v as $k2=>$v2)
				{
					$outc .= "<td>$v2[dormlou]</td><td>$v2[dormnum]</td><td>$v2[year]</td><td>$v2[xueqi]</td><td>$v2[month]</td><td>$v2[score]</td><td>$v2[recorder]</td></tr>";
				}
			}
			echo $outc;
		}
		echo "</table>";
}else{
 $title="星级宿舍";
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
     
<div class="menu tc">
	<a href="sushe_star_s.php">普通录入</a>　　
	<!--<a href="data_in.php?name=sushe_star">导入数据</a>　　-->
<a href="<?php echo "sushe_star.php?act=out&s_major=$s_major&s_class=$s_class&xuenian=$year&xueqi=$xueqi&month=$month"; ?>">导出数据</a>　　<br/>
<form  action="sushe_star.php" method="get"  class="disin">
<input type='hidden' name='act' value='list'>
	　月份<select name="month"><option value=''>全部</option>
	<?php
	foreach($monthdata as $v){
		$se = ($v->month == $month)? " selected " : "";
		echo "<option $se value='$v->month'>$v->month</option>";
	}
	?></select>　　
<?php
	require_once 's_year_class.php';
	require_once 's_xuenian(qi).php';
?>
</form>
</div>
<form  method="post">
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>选择</td>
	<td>班级</td>
	<td>宿舍楼</td>
	<td>宿舍号</td>
	<td>学年</td>
	<td>学期</td>
	<td>月份</td>
	<td>星级</td>
	<td>记录人</td>
	<td colspan="2">操作</td>
</tr>
<?php
	if($_REQUEST['act'] =='list')
	{
/*	if(count($data)>0)
	{	
		foreach($data as $k=>$v)
		{
			$num = count($v);
			echo "<tr>";
			echo "<td rowspan='$num'>$k</td>";
			foreach($v as $k2=>$v2)
			{
				echo "<td>$v2[dormlou]</td>
							<td>$v2[dormnum]</td>
							<td>$v2[year]</td>
							<td>$v2[xueqi]</td>
							<td>$v2[month]</td>
							<td>$v2[score]</td>
							<td>$v2[recorder]</td>
							<td><a href='scholar_del.php?act=sushe_star_del&id=$v2[id]&s_major=$s_major&s_class=$s_class&xuenian=$year&xueqi=$xueqi&month=$month' onClick='delete_confirm' >删除</a></td>
							<td><a href='sushe_star_modify.php?act=sel&id=$v2[id]'>修改</a></td>
							</tr>";
			}
		}
	}*/
	if(count($result)>0)
	{	
		foreach($result as $k=>$v)
		{
			echo "<tr>";
			echo "<td><input id=\"slt$v->nid\" type=\"checkbox\" name=\"chk[]\" value=\"$v->nid\" /></td>";
			echo "<td>$v->classname</td>
				<td>$v->dormlou</td>
				<td>$v->dormnum</td>
				<td>$v->xuenian</td>
				<td>$v->xueqi</td>
				<td>$v->month</td>
				<td>$v->score</td>
				<td>$v->recorder</td>
				<td><a href='sushe_star_modify.php?act=sel&id=$v->nid&s_major=$s_major&s_year=$s_year&s_class=$s_class&year=$year&xueqi=$xueqi&month=$month'>修改</a></td>
				<td><a href='scholar_del.php?act=sushe_star_del&id=$v->nid' onClick='delete_confirm' >删除</a></td>";
				echo "</tr>";
		}
	}
		else
		{
			echo "<tr><td colspan='12'>暂无记录</td></tr>";
		}
}else{echo"<tr><td colspan='12'>请输入筛选条件</td></tr>";}
?>
</table>
<br>
<div class="fl" style="text-indent:28px;">
	<input id="slt" type="checkbox"/>&nbsp;&nbsp;
	<select name="stat">
	<option value="">批量应用</option>
	<option value="del">删除</option>
	</select>&nbsp;
	<input type="submit" class="subtn" value="提交" onclick="if(!confirm('确认执行相应操作?')) return false;"/>
</div>
      	<?php include("footer.php");?>
</body>
</html>
<?php
}
?>
