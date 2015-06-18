<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';
$action=$_REQUEST['act'];
//$yeardata = $yiqi_db->get_results("select distinct year from dormzhian");
$zhoucidata = $yiqi_db->get_results("select distinct zhouci from dormzhian order by zhouci ASC");
	$table = dormzhian;
	$sql="select a.id as nid,a.year,a.xueqi,a.zhouci,a.time,a.weiji,a.jibie,a.recorder,b.name,b.sid,c.name as classname,d.id,d.uid from dormzhian a left join student_info b on a.sid = b.sid left join class c on b.classid =c.id left join major d on c.majorid = d.id where 1 ";
	include("sqlresult.php");
if($_GET["act"] == "out")
{
	header("Content-type: application/vnd.ms-excel; charset=gb2312");
	Header("Content-Disposition: attachment; filename=dorm_zhian.xls");
	$tnow = "<td>学号</td><td>姓名</td><td>班级</td><td>周次</td><td>违纪时间</td><td>违纪情况</td><td>级别</td><td>记录人</td>";
	echo "<table border=1><tr>".$tnow."</tr>\n";
	if(count($result) > 0){
			$outc = "";
		foreach($result as $k=>$v)
		{
		$outc .= "<tr>";
		$outc .= "<td>$v->sid</td>
			<td>$v->name</td>
			<td>$v->classname</td>
			<td>$v->zhouci</td>
			<td>$v->time</td>
			<td>$v->weiji</td>
			<td>$v->jibie</td>
			<td>$v->recorder</td>";
		$outc .= "</tr>";
		}
			echo $outc;
		}
		echo "</table>";
}else{
$title="公寓治安";
include("header.php");
?>
<div class="menu" style="text-align:center">
<!--<a href="data_in.php?name=dorm_zhian">导入数据</a>　　-->
<a href="dorm_zhian_s.php">普通录入</a>　　
<a href="<?php echo "dorm_zhian.php?act=out&sname=$sname&sid=$sid&xuenian=$xuenian&xueqi=$xueqi&zhouci=$zhouci"; ?>">导出数据</a>
<br>
<form action="dorm_zhian.php" method="get" class="disin">
<input type="hidden" name="act" value="list">
  周次<select name="zhouci"><option value=''>全部</option>
<?php
	foreach($zhoucidata as $v){
	$se = ($v->zhouci == $zhouci)? " selected " : "";
	echo "<option $se value='$v->zhouci'>$v->zhouci</option>";
}
?>
  </select>
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
	<td>周次</td>
	<td>违纪时间</td>
	<td>违纪情况</td>
	<td>级别</td>
	<td>记录人</td>
	<td colspan="2">操作</td>
</tr>
<?php
if($_REQUEST['act'] =='list')
	{
	if(count($result)>0)
	{
		foreach($result as $k=>$v)
		{
		echo "<tr>";
		echo "<td><input id=\"slt$v->nid\" type=\"checkbox\" name=\"chk[]\" value=\"$v->nid\" /></td>";
		echo "<td>$v->sid</td>
			<td>$v->name</td>
			<td>$v->classname</td>
			<td>$v->zhouci</td>
			<td>$v->time</td>
			<td>$v->weiji</td>
			<td>$v->jibie</td>
			<td>$v->recorder</td>
			<td><a href='dorm_zhian_modify.php?act=sel&id=$v->nid&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi&zhouci=$zhouci'>修改</a></td>
			<td><a href='dorm_zhian.php?act=delete&id=$v->nid' onClick='delete_confirm' >删除</a></td>";
		echo "</tr>";
		}
	}else{echo "<tr><td colspan='10'>暂无记录</td></tr>";}
}else{echo "<tr><td colspan='10'>请输入筛选条件</td></tr>";}
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
