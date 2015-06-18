<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	
//$yeardata = $yiqi_db->get_results("select distinct year from zaocao_class ");
$zhoucidata = $yiqi_db->get_results("select distinct zhouci from zaocao_class order by zhouci ASC");

	$table = zaocao_class;
	$sql="select a.*,a.id as nid,c.id,c.year,c.name,c.majorid,d.id,d.uid from zaocao_class a left join class c on a.class = c.name left join major d on c.majorid = d.id where 1 ";
	include("sqlresult.php");
if($_GET["act"] == "out")
{
	header("Content-type: application/vnd.ms-excel; charset=gb2312");
	Header("Content-Disposition: attachment; filename=zaocao_class_score.xls");
	$tnow = "<td>班级</td><td>学年</td><td>学期</td><td>周次</td><td>质量分</td><td>记录人</td>";
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
 $title="早操-班级";
 include("header.php");
?>
<script type="text/javascript">
function scholar_in(id){
	year = $("select[name=xuenian]").val();
	xueqi = $("select[name=xueqi]").val();
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
<div class="menu tc">
<!--<a href="data_in.php?name=zaocao_class_score">导入数据</a>-->
<a href="zaocao_class_s.php">普通录入</a>　　
<a href="<?php echo "zaocao_class_score.php?act=out&s_major=$s_major&s_year=$s_year&s_class=$s_class&xuenian=$year&xueqi=$xueqi&zhouci=$zhouci";?>">导出数据</a>
<br>
<form action="zaocao_class_score.php" method="get" class="disin">
<input type="hidden" name="act" value="list">
周次<select name="zhouci"><option value=''>全部</option>
<?php
foreach($zhoucidata as $v){
	$se = ($v->zhouci == $zhouci)? " selected " : "";
	echo "<option $se value='$v->zhouci'>$v->zhouci</option>";
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
	<td>学年</td>
	<td>学期</td>
	<td>周次</td>	
	<td>质量分</td>
	<td>记录人</td>
	<td>学年</td>
	<td>学期</td>
	<td colspan="2">操作</td>
</tr>
<?php
if($_REQUEST['act'] =='list')
{
	if(count($result) > 0){
		foreach($result as $k=>$v)
		{
		echo "<tr>";
		echo "<td><input id=\"slt$v->nid\" type=\"checkbox\" name=\"chk[]\" value=\"$v->nid\" /></td>";
		echo "<td>$v->class</td>
			<td>$v->year</td>
			<td>$v->xueqi</td>
			<td>$v->zhouci</td>
			<td>$v->score</td>
			<td>$v->recorder</td>
			<td>$v->year</td>
			<td>$v->xueqi</td>
			<td><a href='zaocao_score_m.php?act=sel&id=$v->nid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi&zhouci=$zhouci'>修改</a></td>
			<td><a href='zaocao_class_score.php?act=delete&id=$v->id&s_major=$s_major&s_class=$s_class&xuenian=$year&xueqi=$xueqi&zhouci=$zhouci' onClick='delete_confirm' >删除</a></td>";
		echo "</tr>";
		}
	}
		else
		{
			echo "<tr><td colspan='12'>暂无记录</td></tr>";
		}
}echo "<tr><td colspan='12'>请输入筛选条件</td></tr>";
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
