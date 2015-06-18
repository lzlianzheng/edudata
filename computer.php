<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	

	$table = computer;
	$sql="select a.*,a.id as nid,b.name,b.sid,b.classid,c.year,c.id,c.majorid,c.name as classname,d.id,d.uid from computer a left join student_info b on a.sid = b.sid left join class c on b.classid = c.id left join major d on c.majorid = d.id where 1";
	include("sqlresult.php");
	if($_REQUEST["act"] == "out")
	{
		header("Content-type: application/vnd.ms-excel; charset=gb2312");
		Header("Content-Disposition: attachment;filename=\"computer.xls\"");
		$tnow = "		
				<td>学号</td>
				<td>姓名</td>
				<td>班级</td>
				<td>一级</td>
				<td>二级</td>
				<td>添加时间</td>";
		echo "<table border=1><tr>".$tnow."</tr>\n";
		if(count($result) > 0)
		{	
			$outc = "";
			foreach($result as $k=>$v)
				{
					$outc .= "<tr>";
					$outc .= "
							<td>$v->sid</td>
							<td>$v->name</td>
							<td>$v->classname</td>
							<td>$v->first</td>
							<td>$v->second</td>
							<td>$v->addtime</td>";
					$outc .= "</tr>";
				}
			echo $outc;
		}
		echo "</table>";
	}
	else
	{
		$title="计算机等级考试信息";
		include("header.php");
		echo "<div class='nav'>
        <span class='fr'>
		</span>
		</div>";
?>
	<div class="menu">　
	<!--<a href="data_in.php?name=stu_leader_record">导入数据</a>-->
	<a href="computer_s.php">普通录入</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="<?php echo "computer.php?act=out&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn"; ?>">导出数据</a>
	<br>
	<form action="computer.php" method="get" class="disin">
	<input type="hidden" name="act" value="list">
<?php
	require_once 's_year_class.php';
	require_once 's_name_sid.php';
?>
	<input type="submit" value="查询" id="submit" />
	</form>
	</div>
	<form  method="post">
	<table cellspacing="0" cellpadding="0" class="t_list tc list5">
	<tr>
		<td>选择</td>
		<td>学号</td>
		<td>姓名</td>
		<td>班级</td>
		<td>一级</td>
		<td>二级</td>
		<td colspan="2">操作</td>
	</tr>
<?php
	if($_REQUEST['act'] =='list')
	{
		if(count($result)>0)
		{
			foreach($result as $k=>$v)
			{
				echo"<tr>
					<td><input id=\"slt$v->nid\" type=\"checkbox\" name=\"chk[]\" value=\"$v->nid\" /></td>
					<td>$v->sid</td>
					<td>$v->name</td>
					<td>$v->classname</td>
					<td>$v->first</td>
					<td>$v->second</td>
					<td><a href='computer_modify.php?act=sel&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&id=$v->nid'>修改</a></td>
					<td><a href='computer.php?act=delete&id=$v->sid' onClick='delete_confirm' >删除</a></td>";
				echo "</tr>";
			}
		}
		else{echo"<tr><td colspan='12'>暂无记录</td></tr>";}
	}	
	else{echo"<tr><td colspan='12'>请输入筛选条件</td></tr>";}
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
	include("footer.php");
?>
	</body>
	</html>
<?php
	}
?>
