<?php
require_once 'include/common.inc.php';

$curpage = $_GET["p"];
$curpage = (isset($curpage) && is_numeric($curpage)) ? $curpage : 1;
if($curpage<1)
	$curpage=1;

$sql = "select * from student_type ";
//$orderby = " order by id asc ";	
$orderby = "";	
$resultcount = $yiqi_db->get_row(str_replace("*","count(*) as c",$sql));
$total = (int)$resultcount->c;
$take = 50;
$totalpage = (int)($total % $take == 0 ? $total / $take : $total / $take + 1);
$curpage = ($totalpage == 0)? 1 : (($curpage > $totalpage)? $totalpage : $curpage) ;
$skip = ($curpage - 1) * $take;
$result = $yiqi_db->get_results($sql . $orderby . " limit $skip,$take ");
$majorpara = globalpara("major");
$url = "stu_type.php?";
$pagerhtml = pager($totalpage,$curpage,$url);
$title="学生类型";
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

<a href="data_in.php?name=stu_type">导入数据</a>　　
<a href="data_out.php?name=stu_type">导出数据</a>　　
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td width=80>编号</td>
	<td>类型</td>
</tr>
<?php
if(count($result) > 0){
	foreach($result as $v){
		echo "<tr>
			<td>$v->id</td>
			<td>$v->name</td>
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
