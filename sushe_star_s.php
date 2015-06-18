<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	
if($_REQUEST['act'] == 'sushe_star_save')
{
	$year=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$cid = $_REQUEST['s_class'];
	$month = $_REQUEST['month'];
	$dormlou = "学".$_REQUEST['dormlou'];
	$dormnum = $_REQUEST['dormnum'];
	$score = $_REQUEST['score'];
	$recorder = $_REQUEST['recorder'];
	$now = date("Y-m-d H:i:s");
	$sql="insert into sushe_star values (null,'$cid','$year','$xueqi','$month','$dormlou','$dormnum','$score','$recorder','$now')";
	$result=$yiqi_db->query($sql);
	if($result == 1)
		exit("添加成功");
	else
		exit("添加失败");
}
$title="星级宿舍录入";
include("header.php");
?>
<script type="text/javascript">
$(document).ready(function(){
	$("select[name=s_major]").change(function(){
		$.get("jsondata.php?type=class&mid="+$(this).val(),null,function(data){
			$("select[name=s_class]").html(data);
		});
	});
});

function scholar_in(){
	year = $("select[name=sch_year]").val();
	xueqi = $("select[name=sch_xueqi]").val();
	if(!year || !xueqi){
		alert("请输入所属学年/学期");
	}else{
		$.get("./sushe_star_s.php?act=sushe_star_save&year="+year+"&xueqi="+xueqi,$("#sl_ws").serialize(),function(data){
			alert(data);
			$("#sl_ws")[0].reset();
		});
	}
	return false;
}
</script>
<div class="menu tc">
　
<a href="sushe_star.php">返回</a>　

所属学年<select name='sch_year'><option value=''>请选择</option>
	<?php
	foreach($yeardata as $k=>$v)
	{
	 if($sch_year == $v)
	  echo "<option value='$v' selected>$v</option>";
	 else
	  echo "<option value='$v'>$v</option>";
	}
	?>
	</select>
学期<select name='sch_xueqi'><option value=''>请选择</option>
	<option <?php if($sch_xueqi==1) echo "selected"; ?> value="1">第一学期</option>
	<option <?php if($sch_xueqi==2) echo "selected"; ?> value="2">第二学期</option>
	</select>
<!--/form-->
</div>

<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>班级</td>
	<td>宿舍楼</td>
	<td>宿舍号</td>
	<td>星级</td>
	<td>所属月份</td>
	<td>记录人</td>	
	<td>操作</td>
</tr>
<?php
		echo "<form  id='sl_ws' method='get' onsubmit='scholar_in();return false;'><tr>";
	echo "<td>";
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
	$cpara_sql = "select * from class where 1";
	if($s_year){$cpara_sql .=" and year=$s_year";}
	if($s_major){$cpara_sql .=" and majorid=$s_major";}
	$cpara_sql .= " order by name";
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
		echo	"</td>
			<td>学<input type='text' name='dormlou' value='' size=10 /></td>
			<td><input type='text' name='dormnum' value='' size=10 /></td>
			<td><select name='score'><option value=''>请选择</option><option value='1'>一星</option><option value='2'>二星</option><option value='3'>三星</option><option value='4'>四星</option><option value='5'>五星</option></select></td>
			<td><input type='text' name='month' value='' size=15 /></td>
			<td><input type='text' name='recorder' value='' size=15 /></td>
			<td><input type='submit' value='写入'/></td></tr></form>";
?>
</table>
      	<?php include("footer.php");?>
</body>
</html>
