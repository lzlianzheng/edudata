<?php
require_once 'include/common.inc.php';

$curpage = $_GET["p"];
$curpage = (isset($curpage) && is_numeric($curpage)) ? $curpage : 1;
if($curpage<1)
	$curpage=1;
$jieci = $_GET["jieci"];
$sql = "select * from xueshenghui where 1";
$sql .= ($jieci)? " and jieci='$jieci'" : "" ;
//$orderby = " order by edittime desc,id desc ";	
$orderby = "";	
$resultcount = $yiqi_db->get_row(str_replace("*","count(*) as c",$sql));
$total = (int)$resultcount->c;
$take = 50;
$totalpage = (int)($total % $take == 0 ? $total / $take : $total / $take + 1);
$curpage = ($totalpage == 0)? 1 : (($curpage > $totalpage)? $totalpage : $curpage) ;
$skip = ($curpage - 1) * $take;
$result = $yiqi_db->get_results($sql . $orderby . " limit $skip,$take ");
$url = "xueshenghui.php?jieci=$jieci&";
$pagerhtml = pager($totalpage,$curpage,$url);
$jiecidata = $yiqi_db->get_results("select distinct jieci from xueshenghui");
if($_REQUEST['act']=='delete')
{
$id=$_GET['id'];
$sql="delete from xueshenghui where id=$id";
$yiqi_db->query($sql);
echo "<script type=text/javascript>alert('删除成功');window.history.go(-1);</script>";exit;
}
$title="分团委学生会";
include("header.php");
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#pagego_do").click(function(){
		v = parseInt($("#pagego").val()); 
		if(v > <?php echo $totalpage; ?> || isNaN(v))
		{
			alert("请输入正确的页码。");
		}else
		{ 
			window.location.href="<?php echo $url; ?>p=" + v;
		}
	});
});
</script>
<div class="menu">

<a href="data_in.php?name=xueshenghui">导入数据</a>　
<a href="xueshenghui_insert.php">普通录入</a>　
<a href="data_out.php?name=xueshenghui">导出数据</a>　　
<form action="" method="get">
按届次查询<select name="jieci"><option value="">请选择</option>
<?php
foreach($jiecidata as $v){
	$se = ($v->jieci == $jieci)? " selected " : "";
	echo "<option $se value='$v->jieci'>$v->jieci</option>";
}
?>
</select>　　
<input type="submit" value="提交" id="submit" />
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td width=80>编号</td>
	<td>届次</td>
	<td>职务</td>
	<td>姓名</td>
	<td>班级</td>
	<td>电话</td>
	<td>操作</td>
</tr>
<?php
if(count($result) > 0){
	foreach($result as $v){
		echo "<tr>
			<td>$v->id</td>
			<td>$v->jieci</td>
			<td>$v->zhiwu</td>
			<td><a href='xueshenghui_d.php?id=$v->id'>$v->name</td>
			<td>$v->classname</td>
			<td>$v->phone</td>
			<td><a href='xueshenghui.php?act=delete&id=$v->id' onClick='delete_confirm' >删除</a></td>
		</tr>";
	}
}
?>
</table>
<?php
 if($totalpage > 1)
 {	
	echo '<div class="pager">总计 '.$total.' 条记录，每页 '.$take.' 条，共 '.$totalpage.' 页。　　　　　到第<input type="text" id="pagego" />页 <input type="button" value=" GO " id="pagego_do" />　'.$pagerhtml.'</div>';
 }
?>

      	<?php include("footer.php");?>
</body>
</html>
