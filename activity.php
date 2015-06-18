<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	

	$table = activity_join;
	$sql="select a.*,a.id as nid,a.xuenian,a.xueqi,b.name,b.sid,b.classid,c.year,c.id,c.majorid,c.name as classname,d.id,d.uid from activity_join a left join student_info b on a.sid = b.sid left join class c on b.classid = c.id left join major d on c.majorid = d.id where 1";
	$panduan = 1;//判断主表单里表示学年的字段名是year还是xuenian,是xuenian则为1；
	include("sqlresult.php");
	if($_REQUEST['act'] =='out')
	{
		header("Content-type: application/vnd.ms-excel; charset=gb2312");
		Header("Content-Disposition: attachment; filename=activity.xls");
		$tnow = "		
				<td>学号</td>
				<td>姓名</td>
				<td>班级</td>
				<td>活动内容</td>
				<td>活动时间</td>
				<td>活动级别</td>
				<td>学年</td>
				<td>学期</td>
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
						<td>$v->content</td>
						<td>$v->act_date</td>
						<td>$v->jibie</td>
						<td>$v->xuenian</td>
						<td>$v->xueqi</td>
						<td>$v->addtime</td>";
				$outc .= "</tr>";
			}
			echo $outc;
		}
		echo "</table>";
	}
	else
	{
		$title="活动参与记录";
		include("header.php");
		echo "<div class='nav'>
        <span class='fr'>
        </span>
		</div>";
?>

	<div class="menu">
	<a href="activity_s.php">普通录入</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="<?php echo "activity.php?act=out&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi"; ?>">导出数据</a>
	<br>
	<form action="activity.php" method="get" class="disin">
	<input type="hidden" name="act" value="list">
<?php
	require_once 's_year_class.php';
	require_once 's_name_sid.php';
	require_once 's_xuenian(qi).php';
?>
	</form>
	</div>
	<form  method="post">
	<table cellspacing="0" cellpadding="0" class="t_list tc list5">
	<tr>
		<td>选择</td>
		<td>学号</td>
		<td>姓名</td>
		<td>班级</td>
		<td>活动名称</td>
		<td>活动内容</td>
		<td>活动时间</td>
		<td>活动级别</td>
		<td>学年</td>
		<td>学期</td>
		<td colspan="2"> 操作</td>
	</tr>
<?php
	if($_REQUEST['act'] =='list')
	{
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
					<td>$v->act_name</td>
					<td>$v->content</td>
					<td>$v->act_date</td>
					<td>$v->jibie</td>
					<td>$v->xuenian</td>
					<td>$v->xueqi</td>
					<td><a href='activity_modify.php?act=sel&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi&id=$v->nid'>修改</a></td>
					<td><a href='activity.php?act=delete&id=$v->nid&sid=$v->sid&year=$v->year&xueqi=$v->xueqi' onClick='delete_confirm' >删除</a></td>";
					echo "</tr>";
			}
		}
		else{echo"<tr><td colspan='12'>暂无记录</td></tr>";}
	}
	else{echo"<tr><td colspan='12'>请输入筛选条件</td></tr>";}
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
	include("footer.php");?>
</body>
</html>
<?php
	}
?>