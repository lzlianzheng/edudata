<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';
$table = student_info;
$sql = "select b.name as stuname,b.*,b.status as stustatus,c.name as classname,c.*,d.* from student_info b left join class c on b.classid = c.id left join major d on c.majorid = d.id where 1 ";
include("sqlresult.php");
if($_REQUEST['act'] =='delete1')
{
	$sid = $_GET["sid"];
$sql="delete from student_info where sid=$sid";
$yiqi_db->query($sql);
echo "<script type=text/javascript>alert('删除成功');window.history.go(-1);</script>";exit;
}
//print("$sql");
/*$action=$_REQUEST['act'];
		$sname = $_GET["sname"];
		$sid = $_GET["sid"];
		$major=$_GET["s_major"];
		$grade=$_GET["s_year"];
		$classn = $_GET["s_class"];

$p = $_GET["p"];
if($action=='ls')
{
			if($sname)
				$sql .=" and a.name like '%$sname%' "; 
			if($sid)
				$sql .=" and a.sid=$sid";
			if($grade)
				$sql .=" and b.year=$grade";
			if($major)
				$sql .=" and b.majorid=$major";
			if($classn)
				$sql .=" and b.id=$classn";
$result=$yiqi_db->get_results($sql);
}
*/
$title="学生信息维护";
include("header.php");
?>
       
<div class="menu">
<!--<a href="data_in.php?name=student">导入数据</a>　　-->
<a href="stu_insert.php">普通录入</a>　　
<a href="data_out.php?name=student">导出数据</a><br>
<form action="student.php" method="get" class="disin">
<input type="hidden" name="act" value="list">

<?php
	require_once 's_year_class.php';
	require_once 's_name_sid.php';
?>
<input type="submit" value="查询" id="submit" />
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td width=80>学号</td>
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
	<td width=50>类型</td>
	<td width=50>状态</td>
	<!--td width=50>父亲</td>
	<td width=90>电话</td>
	<td width=50>母亲</td>
	<td width=90>电话</td>	
	<td width=50>插班生重新考入班级</td>
	<td width=50>转专业前专业</td-->
	<td width=50>操作</td>
</tr>
<?php
if($_REQUEST['act'] =='list')
{
	if(count($result) > 0){
		foreach($result as $v){
			//$classname = $classpara[$v->classid];
			//$nationname = $nationpara[$v->nationid];
			echo "<tr>
				<td>$v->sid</td>
				<td>$v->classname</td>
				<td><a href='stuinfo.php?sid=$v->sid'>$v->stuname</a></td>
				<td>$v->sex</td>
				<td>$v->identity</td>
				<td>$v->birthday</td>
				<td>$v->mobilephone</td>
				<td>$v->dormbn</td>
				<td>$v->dormnumber</td>
				<td>$v->type</td>
				<td>$v->stustatus</td>
				<td><a href='student.php?act=delete1&sid=$v->sid' onClick='delete_confirm' >删除</a></td>
			</tr>";
		}
	}else{echo"<tr><td colspan='12'>暂无记录</td></tr>";}
}else{echo"<tr><td colspan='12'>请输入筛选条件</td></tr>";}
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
