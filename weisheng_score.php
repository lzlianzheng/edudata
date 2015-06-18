<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	
$table = weisheng_yuanji;
//$yeardata = $yiqi_db->get_results("select distinct year from weisheng_yuanji");
$zhoucidata = $yiqi_db->get_results("select distinct zhouci from weisheng_yuanji order by zhouci ASC");

	$table = weisheng_yuanji;
	$sql = "select distinct a.id as nid,a.dormlou,a.dormnum,a.score as score_yuan,a.zhouci,a.year as xuenian,a.xueqi,a.checkdate,a.recorder,b.dormbn,b.dormnumber,b.classid,c.id,c.name as classname,c.majorid,c.year,d.id,d.uid from weisheng_yuanji a left join student_info b on a.dormnum = b.dormnumber and a.dormlou = b.dormbn left join class c on b.classid = c.id left join major d on c.majorid = d.id where 1";
	include("sqlresult.php");

if($_GET["act"] == "out")
{
	header("Content-type: application/vnd.ms-excel; charset=gb2312");
	Header("Content-Disposition: attachment; filename=weisheng_score.xls");
	$tnow = "<td>班级</td><td>宿舍楼</td><td>宿舍号</td><td>周次</td><td>院级得分</td><td>记录日期</td><td>记录人</td>";
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
					$outc .= "<td>$v2[dormlou]</td><td>$v2[dormnum]</td><td>$v2[zhouci]</td><td>$v2[score_yuan]</td><td>$v2[checkdate]</td><td>$v2[recorder]</td></tr>";
				}
			}
			echo $outc;
		}
		echo "</table>";
}else{
$title="宿舍卫生-院级"; 
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
</script>
<div class="menu tc">
	<a href="weisheng_yuanji_s.php">卫生周检查录入(院级)</a>　　
	<a href="weisheng_sch_s.php">卫生周检查录入(校级)</a>　　
<a href="<?php echo "weisheng_score.php?act=out&s_major=$s_major&s_year=$s_year&s_class=$cid&xuenian=$year&xueqi=$xueqi&zhouci=$zhouci"; ?>">导出数据</a>　　<br/>
<form  action="weisheng_score.php" method="get"  class="disin">
<input type='hidden' name='act' value='list'>
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
	<td>宿舍楼</td>
	<td>宿舍号</td>
	<td>周次</td>
	<td>院级得分</td>
	<td>记录时间</td>
	<td>记录人</td>
	<td>学年</td>
	<td>学期</td>
	<td colspan="2">操作</td>
</tr>
<?php
	if($_REQUEST['act'] =='list')
	{
	if(count($result)>0)
	{	
		foreach($result as $k=>$v)
		{
	//		$num = count($v);
			echo "<tr>";
	/*		echo "<td rowspan='$num'>$k</td>";
			foreach($v as $k2=>$v2)
			{
				echo "<td>$v2[dormlou]</td><td>$v2[dormnum]</td><td>$v2[zhouci]</td><td>$v2[score_yuan]</td><td>$v2[checkdate]</td><td>$v2[recorder]</td><td><a href='scholar_del.php?act=weisheng_yuanji_del&id=$v2[id]&s_major=$s_major&s_class=$cid&xuenian=$year&xueqi=$xueqi&zhouci=$zhouci' onClick='delete_confirm' >删除</a></td><td><a href='weisheng_yuanji_modify.php?act=sel&id=$v2[id]'>修改</a></td></tr>";
			}*/
			echo "<td><input id=\"slt$v->nid\" type=\"checkbox\" name=\"chk[]\" value=\"$v->nid\" /></td>";
			echo "<td>$v->classname</td>
				<td>$v->dormlou</td>
				<td>$v->dormnum</td>
				<td>$v->zhouci</td>
				<td>$v->score_yuan</td>
				<td>$v->checkdate</td>
				<td>$v->recorder</td>
				<td>$v->xuenian</td>
				<td>$v->xueqi</td>
				<td><a href='weisheng_yuanji_modify.php?act=sel&id=$v->nid&s_major=$s_major&s_year=$s_year&s_class=$s_class&year=$year&xueqi=$xueqi&zhouci=$zhouci'>修改</a></td>
				<td><a href='weisheng_score.php?act=delete&id=$v->nid' onClick='delete_confirm' >删除</a></td>";
				echo "</tr>";
		}
	}		
	else{echo"<tr><td colspan='12'>暂无记录</td></tr>";}
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
