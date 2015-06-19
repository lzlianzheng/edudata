<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	

	$table = cp_cla_leader;
	$sql="select a.*,a.id as nid,a.year as xuenian,a.xueqi,b.name,b.sid,b.classid,c.year,c.id,c.majorid,c.name as classname,d.id,d.uid from cp_cla_leader a left join student_info b on a.sid = b.sid left join class c on b.classid = c.id left join major d on c.majorid = d.id where 1";
	if($_REQUEST['act'] =='cp_cla_leader')
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
	else
	{
		$title="测评记录";
		include("header.php");
?>

	<table cellspacing="0" cellpadding="0" class="t_list list5">
	<tr>
	<div class="menu">
	<form action="cp_cla_leader.php" method="get" class="disin">
	<input type="hidden" name="act" value="cp_cla_leader">
	<td width='30%' align=center>班级干部测评</td>
<?php
	$s_major=$_GET["s_major"];
	$s_year=$_GET["s_year"];
	$s_class=$_GET["s_class"];
	echo "<td width='70%'>专业 <select name='s_major'><option value=''>请选择</option>";
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
<?php
	$xuenian=$_GET["xuenian"];
	$xueqi=$_GET["xueqi"];
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
	<input type="submit" value="查询" id="submit" /></td>
	</div></form>
	</tr>
	</table>


	<table cellspacing="0" cellpadding="0" class="t_list list5"><tr>
	<div class="menu">
	<form action="cp_cla_leader.php" method="get" class="disin">
	<input type="hidden" name="act" value="cp_su_ganshi">
	<td width='30%' align=center>学生会干事评测</td>
<?php

	echo "<td width='70%'>届次 <select name='s_major'><option value=''>请选择</option>";
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
	echo "所在部门 <select name='s_class'><option value=''>请选择</option>";
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
	<input type="submit" value="查询" id="submit" /></td>
	</form>
	</div>
	</tr>
	</table>

	
	<table cellspacing="0" cellpadding="0" class="t_list list5">
	<tr>
	<div class="menu">
	<form action="cp_cla_leader.php" method="get" class="disin">
	<input type="hidden" name="act" value="hour_su_leader">
	<td width='30%' align=center>学生会干部评测</td>
<?php
	$s_major=$_GET["s_major"];
	$s_year=$_GET["s_year"];
	$s_class=$_GET["s_class"];
	echo "<td width='70%'>届次 <select name='s_major'><option value=''>请选择</option>";
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
?>
	<input type="submit" value="查询" id="submit" /></td>
	</form>
	</div>
	</table>

	</br>
<?php
if($_REQUEST['act'] =='cp_cla_leader')
{
?>
		<form  method="post">
		<table cellspacing="0" cellpadding="0" class="t_list tc list5">
		<tr>
			<td>选择</td>
			<td>学号</td>
			<td>姓名</td>
			<td>班级</td>
			<td>评定等级</td>
			<td>学年</td>
			<td>学期</td>
			<td colspan="2"> 操作</td>
		</tr>
	<?php

			if(count($result)>0)
			{
				foreach($result as $k=>$v)
				{
						echo "<tr>".
						"<td><input id=\"slt$v->nid\" type=\"checkbox\" name=\"chk[]\" value=\"$v->nid\" /></td>";
						echo "
						<td>$v->sid</td>
						<td>$v->name</td>
						<td>$v->classname</td>
						<td>$v->cpdengji</td>
						<td>$v->xuenian</td>
						<td>$v->xueqi</td>
						<td><a href='cp_cla_leader_modify.php?act=sel&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi&id=$v->nid'>修改</a></td>
						<td><a href='cp_cla_leader.php?act=delete&id=$v->nid&sid=$v->sid&year=$v->year&xueqi=$v->xueqi' onClick='delete_confirm' >删除</a></td>";
						echo "</tr>";
				}
			}
			else{echo"<tr><td colspan='12'>暂无记录</td></tr>";}

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
	</form>	
<?php
}

if($_REQUEST['act'] =='cp_su_ganshi')
{
?>
	<form  method="post">
	<table cellspacing="0" cellpadding="0" class="t_list tc list5">
	<tr>
		<td>选择</td>
		<td>学号</td>
		<td>姓名</td>
		<td>班级</td>
		<td>级别</td>
		<td>名称</td>
		<td>学年</td>
		<td>学期</td>
		<td colspan="2"> 操作</td>
	</tr>
<?php
		if(count($result)>0)
		{
			foreach($result as $k=>$v)
			{
				if($v->jibie)
				{
					echo "<tr>".
					"<td><input id=\"slt$v->nid\" type=\"checkbox\" name=\"chk[]\" value=\"$v->nid\" /></td>";
					echo "
						<td>$v->sid</td>
						<td>$v->name</td>
						<td>$v->classname</td>
						<td>$v->jibie</td>";
						if("$v->mingcheng" == 1) echo "<td>优秀学生会干事</td>";else echo "<td>无</td>";
						echo "<td>$v->xuenian</td>
						<td>$v->xueqi</td>
						<td><a href='cp_su_ganshi_modify.php?act=sel&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi&id=$v->nid'>修改</a></td>
						<td><a href='cp_su_ganshi.php?act=delete&id=$v->nid' onClick='delete_confirm' >删除</a></td>";
					echo "</tr>";
				}
			}
		}
		else{echo"<tr><td colspan='12'>暂无记录</td></tr>";}
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
</form>	
<?php
}

if($_REQUEST['act'] =='hour_su_leader')
{
?>
<form  method="post">
	<table cellspacing="0" cellpadding="0" class="t_list tc list5">
	<tr>
		<td>选择</td>
		<td>学号</td>
		<td>姓名</td>
		<td>班级</td>
		<td>级别</td>
		<td>名称</td>
		<td>学年</td>
		<td>学期</td>
		<td colspan="2">操作</td>
	</tr>
<?php
		if(count($result)>0)
		{
			foreach($result as $k=>$v)
			{
				echo"<tr>
					<td><input id=\"slt$v->nid\" type=\"checkbox\" name=\"chk[]\" value=\"$v->nid\" /></td>
					<td>$v->sid</td>
					<td>$v->name</td>
					<td>$v->classname</td>
					<td>$v->jibie</td>
					<td>$v->mingcheng</td>
					<td>$v->xuenian</td>
					<td>$v->xueqi</td>
					<td><a href='hour_su_leader_modify.php?act=sel&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi&id=$v->nid'>修改</a></td>
					<td><a href='hour_su_leader.php?act=delete&id=$v->sid' onClick='delete_confirm' >删除</a></td>";
				echo "</tr>";
			}
		}
		else{echo"<tr><td colspan='12'>暂无记录</td></tr>";}
?>
	</table>
	<br>
	<div class="fl" style="text-indent:20px;">
		<input id="slt" type="checkbox"/>&nbsp;&nbsp;
		<select name="stat">
		<option value="">批量应用</option>
		<option value="del">删除</option>
		</select>&nbsp;
		<input type="submit" class="subtn" value="提交" onclick="if(!confirm('确认执行相应操作?')) return false;"/>
	</div>
	</form>
<?php
}
?>
<?php 
	include("footer.php");?>
</body>
</html>
<?php
	}
?>