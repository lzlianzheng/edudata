<?php
require_once 'include/common.inc.php';
$sname = $_GET["sname"];
if($sname)
{
$curpage = $_GET["p"];
$curpage = (isset($curpage) && is_numeric($curpage)) ? $curpage : 1;
if($curpage<1)
	$curpage=1;
$sql = "select * from student_info where 1 ";
$sql .= ($sname)? " and name like '%$sname%' " : "" ;
//$orderby = " order by addtime desc ";	
$orderby = "";	
$resultcount = $yiqi_db->get_row(str_replace("*","count(*) as c",$sql));
$total = (int)$resultcount->c;
$take = 50;
$totalpage = (int)($total % $take == 0 ? $total / $take : $total / $take + 1);
$curpage = ($totalpage == 0)? 1 : (($curpage > $totalpage)? $totalpage : $curpage) ;
$skip = ($curpage - 1) * $take;
$result = $yiqi_db->get_results($sql . $orderby . " limit $skip,$take ");
$classpara = globalpara("class");
$nationpara = globalpara("nation");
$url = "student.php?sname=$sname&";
$pagerhtml = pager($totalpage,$curpage,$url);
}
$sid = $_GET["sid"];
$action=$_REQUEST['act'];
if($action=='delete')
{
$sql="delete from student_info where sid=$sid";
$yiqi_db->query($sql);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="images/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="images/jquery-1.6.1.min.js"></script>
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
function delete_confirm(e) 
{
    if (event.srcElement.outerText == "删除") 
    {
        event.returnValue = confirm("删除是不可恢复的，你确认要删除吗？");
    }
}
document.onclick = delete_confirm;
</script>
<body>
<div class="mainbody">
<div class="menu" style="text-align:center">
<a href="list.php">返回</a>　　
<a href="data_in.php?name=student">导入数据</a>　　
<a href="data_out.php?name=student">导出数据</a><br>
<form action="student.php" method="get" class="disin">
按姓名查询<input type="text" name="sname">
<input type="submit" value="提交" id="submit" />
</form>
<form action="stuinfo.php" method="get" class="disin">
按学号查询<input type="text" name="sid" />
<input type="submit" value="提交" id="submit" />
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td width=80>编号</td>
	<td width=80>班级</td>
	<td width=60>姓名</td>
	<td width=50>性别</td>
	<td width=150>身份证</td>
	<td width=110>生日</td>
	<!--td width=50>照片</td>
	<td width=50>民族</td>
	<td width=80>籍贯</td>
	<td width=200>家庭地址</td>
	<td width=60>邮编</td-->
	<td width=90>电话</td>
	<td width=50>宿舍楼</td>
	<td width=50>宿舍号</td>
	<!--td width=50>父亲</td>
	<td width=90>电话</td>
	<td width=50>母亲</td>
	<td width=90>电话</td-->
	<td width=50>类型</td>
	<td width=50>状态</td>
	<td>操作</td>
</tr>
<?php
if(count($result) > 0){
	foreach($result as $v){
		$classname = $classpara[$v->classid];
		$nationname = $nationpara[$v->nationid];
		echo "<tr>
			<td>$v->sid</td>
			<td>$classname</td>
			<td><a href='stuinfo.php?sid=$v->sid'>$v->name</a></td>
			<td>$v->sex</td>
			<td>$v->identity</td>
			<td>$v->birthday</td>
			<td>$v->mobilephone</td>
			<td>$v->dormbn</td>
			<td>$v->dormnumber</td>
			<td>$v->type</td>
			<td>$v->status</td>
			<td><a href='student.php?act=delete&sid=$v->sid' onClick='delete_confirm'>删除</a></td>
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
</div>
</body>
</html>
