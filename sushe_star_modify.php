<?php
require_once 'include/common.inc.php';
$stararr = array("请选择","一星","二星","三星","四星","五星");
$major=$_GET["s_major"];
$grade=$_GET["s_year"];
$classn = $_GET["s_class"];
$sxuenian = $_GET["xuenian"];
$sxueqi = $_GET["xueqi"];
$month = $_GET["month"];
if($_GET['act'] == 'sel')
{
$id = $_GET['id'];
$sql = "select * from sushe_star where id = '$id'";
$result = $yiqi_db->get_row($sql);
$yeardata = array('2011-2012','2012-2013','2013-2014','2014-2015','2015-2016','2016-2017','2017-2018','2018-2019','2019-2020','2020-2021');
}
$title="星级宿舍记录修改";
include("header.php");
?>
<div class="menu tc">
<h2 style="text-align:center;display:inline-block">星级宿舍</h2><br/>
<a href="<?php echo "sushe_star.php?act=stat&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi&month=$month"; ?>">返回</a>　
</div>
<form action="modify.php?act=sushe_star" method="post">
<input type="hidden" name="id" value="<?php echo $result->id; ?>" />
<table cellspacing="0" cellpadding="0" class="t_list list4">

<tr>
	<td>学年</td>
	<td>
		<select name="xuenian"><option value="0">请选择</option>
	<?php
	foreach($yeardata as $v){
	$se = ($v == "$result->year")? " selected " : "";
	echo "<option $se value=$v>$v</option>";
	}
	?>
		</select>
	</td>
	<td>学期</td>
	<td><input type="text" name="xueqi" value="<?php echo $result->xueqi; ?>" /></td>
</tr>
<tr>
	<td>宿舍楼</td>
	<td><input type="text" name="dormlou" value="<?php echo $result->dormlou; ?>" /></td>
	<td>宿舍号</td>
	<td><input type="text" name="dormnum" value="<?php echo $result->dormnum; ?>" /></td>
</tr>
<tr>
	<td>月份</td>
	<td><input type="text" name="month" value="<?php echo $result->month; ?>" /></td>
	<td>星级</td>
	<td>
		<select name="score">
	<?php
	foreach($stararr as $k=>$v){
	$se = ($k == $result->score)? " selected " : "";
	echo "<option $se value=$k>$v</option>";
	}
	?>
		</select>
	</td>
</tr>
<tr>
	<td>记录人</td>
	<td><input type="text" name="recorder" value="<?php echo $result->recorder; ?>" /></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
	<?php include("footer.php");?>
</body>
</html>
