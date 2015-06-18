<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	

	$table = sbisai_prize;
	$sql="select a.*,a.id as nid,b.name,b.sid,b.classid,c.year,c.id,c.majorid,c.name as classname,d.id,d.uid from sbisai_prize a left join student_info b on a.sid = b.sid left join class c on b.classid = c.id left join major d on c.majorid = d.id where 1";
	include("sqlresult.php");
if($_GET["act"] == "out"){
	header("Content-type: application/vnd.ms-excel; charset=gb2312");
	Header("Content-Disposition: attachment; filename=bisai_prize.xls");
	$tnow = "<td>班级</td><td>姓名</td><td>获奖级别</td><td>获奖名称</td><td>名次</td>";
	echo "<table border=1><tr>".$tnow."</tr>\n";
	if(count($data) > 0){
	foreach($data as $k=>$v){
		$cnow=0;
		foreach($v['dlist'] as $k1=>$v1)
		{
		$col=count($v1);
		$cnow=$cnow+$col;
		}
		$outc.= "<tr><td rowspan='$cnow'>".$v["classname"]."</td>";
		if($cnow>0){
			foreach($v['dlist'] as $k1=>$v1){
				$col=count($v1);
				//$i=$i+$col;
				$outc .= "<td rowspan='$col'>$k1</td>";
				  foreach($v1 as $k2=>$v2)
				  {
					$outc .= "<td>".$v2[0]."</td>
					<td>".$v2[1]."</td>
					<td>".$v2[2]."</td>
					</tr>";
				  }
			}
		}else{
			$outc .= "<td>暂无数据</td><td>暂无数据</td><td>暂无数据</td><td>暂无数据</td></tr>";
		}
		
	}
	echo $outc;
}
		echo "</table>";
}else{

$title="竞赛获奖";
include("header.php");
?>
<div class="menu tc">　
<!--<a href="data_in.php?name=bisai_prize">批量导入竞赛获奖</a>-->　　
<a href="bisai.php">普通录入</a>　　
<a href="<?php echo "bisai_prize.php?act=out&s_year=$s_year&s_major=$s_major&s_class=$s_class&xuenian=$xuenian&xueqi=$xueqi"; ?>">导出数据</a><br/>　

<form action="bisai_prize.php" method="get" class="disin">
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
	<td>姓名</td>
	<td>班级</td>
	<td>获奖类别</td>
	<td>获奖级别</td>
	<td>获奖名称</td>
	<td>名次</td>
	<td colspan="2">操作</td>
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

					<td>$v->name</td>
					<td>$v->classname</td>
					<td>$v->leibie</td>
					<td>$v->level</td>
					<td>$v->prizename</td>
					<td>$v->prizegrade</td>
					<td><a href='bisai_d.php?act=sel&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi&id=$v->nid'>修改</a></td>
					<td><a href='bisai_prize.php?act=delete&id=$v->nid&sid=$v->sid&year=$v->year&xueqi=$v->xueqi' onClick='delete_confirm' >删除</a></td>";
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
      	<?php include("footer.php");?>
</body>
</html>
<?php
}
?>
