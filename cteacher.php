<?php
require_once 'include/common.inc.php';
$title="班主任信息维护";
include("header.php");
$curpage = $_GET["p"];
$curpage = (isset($curpage) && is_numeric($curpage)) ? $curpage : 1;
if($curpage<1)
	$curpage=1;
$sql = "select * from cteacher where 1 ";
//$orderby = " order by addtime desc ";	
$orderby = "";	
$resultcount = $yiqi_db->get_row(str_replace("*","count(*) as c",$sql));
$total = (int)$resultcount->c;
$take = 50;
$totalpage = (int)($total % $take == 0 ? $total / $take : $total / $take + 1);
$curpage = ($totalpage == 0)? 1 : (($curpage > $totalpage)? $totalpage : $curpage) ;
$skip = ($curpage - 1) * $take;
$result = $yiqi_db->get_results($sql . $orderby . " limit $skip,$take ");
$url = "cteacher.php?";
$pagerhtml = pager($totalpage,$curpage,$url);
if($_REQUEST['act']=='delete')
{
$t_id=$_GET['tid'];
$sql="delete from cteacher where tid=$t_id";
$yiqi_db->query($sql);
echo "<script type=text/javascript>alert('删除成功');window.history.go(-1);</script>";exit;
}
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
<!--<a href="data_in.php?name=cteacher">导入数据</a>　-->
<a href="teacher_insert.php">普通录入</a>　　
<a href="data_out.php?name=cteacher">导出数据</a>
</div>
<form action >
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>序号</td>
	<td>姓名</td>
	<td>工号</td>
	<td>性别</td>
	<td>生日</td>
	<td>政治面貌</td>
	<td>学历</td>
	<td>职称</td>
	<td>聘任时间</td>
	<td>工作部门</td>
	<td>职务级别</td>
	<td>专兼职</td>
	<td>电话</td>
	<td>操作</td>
</tr>
<?php
if(count($result) > 0){
	foreach($result as $v){
		echo "<tr>
			<td>$v->id</td>
			<td><a href='cteacher_d.php?id=$v->id'>$v->name</a></td>
			<td>$v->tid</td>
			<td>$v->sex</td>
			<td>$v->birthday</td>
			<td>$v->zhengzhi</td>
			<td>$v->xueli</td>
			<td>$v->zhicheng</td>
			<td>$v->worktime</td>
			<td>$v->bumen</td>
			<td>$v->zhiwu</td>
			<td>$v->zhuanjian</td>
			<td>$v->mobile</td>
			<td><a href='cteacher.php?act=delete&tid=$v->tid' onClick='delete_confirm' >删除</a></td>
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
