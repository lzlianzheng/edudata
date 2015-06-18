<?php
require_once 'include/common.inc.php';

$sid = $_GET["sid"];
$sql = "select * from student_info where sid='$sid' ";
$result = $yiqi_db->get_row($sql);
$sql1 = "select * from class where id='$result->classid' ";
$result1 = $yiqi_db->get_row($sql1);
$teacher = $yiqi_db->get_row("select * from cteacher where name='$result1->deanteacher'");
$classpara = globalpara("class");
$nationpara = globalpara("nation");
$sql2="select sid,name,year,xueqi,scholarship from scholarship where sid=$sid";
$re2=$yiqi_db->get_results($sql2);
$sql3="select sid,name,year,xueqi,honourname,jibie from stuhonour where sid=$sid";
$re3=$yiqi_db->get_results($sql3);

$moniphone = $yiqi_db->get_row("select mobilephone from student_info where classid = '$result->classid' and name = '$result1->monitor'");

$action = $_POST['act'];
$name=$_POST['name'];
$stuid=$_POST['sid'];
$classname=$_POST['classname'];
$sex=$_POST['sex'];
$nation=$_POST['nation'];
$identity=$_POST['identity'];
$birthday=$_POST['birthday'];
$mobilephone=$_POST['mobilephone'];
$dormbn=$_POST['dormbn'];
$dormnumber=$_POST['dormnumber'];
$type=$_POST['type'];
$fathername=$_POST['fathername'];
$fathermobilephone=$_POST['fathermobilephone'];
$mathername=$_POST['mathername'];
$mathermobilephone=$_POST['mathermobilephone'];
$homeaddress=$_POST['homeaddress'];
$zipcode=$_POST['zipcode'];
$status=$_POST['status'];
$initial=$_POST['initial'];
$first=$_POST['first'];
$beizhu = $_POST['beizhu'];
if($action=='upd')
{
$classid=$yiqi_db->get_row("select id from class where name='$classname'");
$cid=$classid->id;
$nat=$yiqi_db->get_row("select id from nation where name='$nation'");
$nation_id=$nat->id;
$sql="update student_info set name='$name',classid= $cid,sex='$sex',identity='$identity',birthday='$birthday',nationid=$nation_id,homeaddress='$homeaddress',zipcode='$zipcode',mobilephone='$mobilephone',dormbn='$dormbn',dormnumber='$dormnumber',fathername='$fathername',fathermobilephone='$fathermobilephone',mathername='$mathername',mathermobilephone='$mathermobilephone',type='$type',status = '$status',initial = '$initial',first = '$first',beizhu='$beizhu' where sid=$stuid ";
$a=$yiqi_db->query($sql);
if($a)
{
echo "<script type=text/javascript>alert('更新成功');window.history.go(-1);</script>";exit;
}else
{
echo "<script type=text/javascript>alert('更新失败，请检查填写信息是否有误');window.history.go(-1);</script>";exit;
}
}
$title="学生基本信息";
include("header.php");

$action2=$_GET['chaxun'];
$action3=$_GET['chaxunxm'];

if($action2=='search')
{
$sid=$_GET['stuid'];
$sql = "select * from student_info where sid='$sid' ";
$result = $yiqi_db->get_row($sql);
$sql1 = "select * from class where id='$result->classid' ";
$result1 = $yiqi_db->get_row($sql1);
$teacher = $yiqi_db->get_row("select * from cteacher where name='$result1->deanteacher'");
$classpara = globalpara("class");
$nationpara = globalpara("nation");
$sql2="select sid,name,year,xueqi,scholarship from scholarship where sid=$sid";
$re2=$yiqi_db->get_results($sql2);
$sql3="select sid,name,year,xueqi,honourname,jibie from stuhonour where sid=$sid";
$re3=$yiqi_db->get_results($sql3);
}

if($action3=='searchxm')
{
 $sname=$_GET['stuname'];
 $sql="select * from student_info where name='$sname'";
 $result=$yiqi_db->get_row($sql);
 $sql1="select * from class where id='$result->classid'";
 $result1=$yiqi_db->get_row($sql1);
 $teacher = $yiqi_db->get_row("select * from cteacher where name='$result1->deanteacher'");
 $classpara = globalpara("class");
 $nationpara = globalpara("nation");
 $sql2="select sid,name,year,xueqi,scholarship from scholarship where name='$sname'";
 $re2=$yiqi_db->get_results($sql2);
 $sql3="select sid,name,year,xueqi,honourname,jibie from stuhonour where name='$sname'";
 $re3=$yiqi_db->get_results($sql3);
}

?>
<!Doctype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://w.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
<link href="images/main.css" rel="stylesheet" type="text/css" media="" />
<link href="images/print2.css" rel="stylesheet" type="text/css" media="print" />
<script type="text/javascript" src="images/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="images/printarea.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#print").click(function(){
		$("#printarea").printArea();
	});
});
</script>
</head>
<body>
<div class="tc ptop"><input type="button" value=" 打 印 " id="print" />　　　<input type="button" value=" 返 回 " onclick="history.go(-1)" /><br/>
友情提示：打印前请先将浏览器默认的页眉页脚去掉。（在浏览器窗口顶部点击 文件->页面设置 ，修改相应选项。）
</div>
<h2 style="text-align:center">学生基本信息</h2>
<div style="text-align:center;margin-top:10px">
<form action="" method="get">
 <input type="hidden" name="chaxun" value="search">
学号：<input type="text" name="stuid" value="<?php echo $sid;?>" />
<input type="submit" value="查询" id="submit" />
</form>
<form action="" method="get">
 <input type="hidden" name="chaxunxm" value="searchxm">
姓名：<input type="text" name="stuname" value="<?php echo $sname;?>" />
<input type="submit" value="查询" id="submit" />
</form>
</div>
<div id="printarea" class="stuinfo">
<form action="stuinfo.php" method="post">
<input type="hidden" name="act" value="upd">
<div>
<table>
	<tr>
	<td>
		<table>
		<tr><td>学号：</td><td><input type="text" name="sid" value="<?php echo $result->sid;?>" readonly/></td></tr>
		<tr><td>姓名：</td><td><input type="text" name="name" value="<?php echo $result->name; ?>" /></td></tr>		
		<tr><td>班级：</td><td><input type="text" name="classname" value="<?php $classname=$classpara[$result->classid];echo $classname;?>" /></td></tr>
		<tr><td>性别: </td><td><input type="text" name="sex" style="width:30px" value="<?php echo $result->sex;?>"/>　民族：<input type="text" name="nation" style="width:70px" value="<?php $nationname=$nationpara[$result->nationid];echo $nationname;?>" /></td></tr>
		<tr><td>身份证号：</td><td><input type="text" name="identity" value="<?php echo $result->identity;?>" /></td></tr>
		<tr><td>生日：</td><td><input type="text" name="birthday" value="<?php echo $result->birthday;?>"/></td></tr>
		<tr><td>学生手机：</td><td><input type="text" name="mobilephone" value="<?php echo $result->mobilephone;?>"/></td></tr>
		<tr><td>宿舍：</td><td><input type="text" name="dormbn" style="width:40px" value="<?php echo $result->dormbn;?>" /><input type="text" name="dormnumber" style="width:105px" value="<?php echo $result->dormnumber;?>"/></td></tr>
		</table>
	</td>
	<td><textarea cols="20" rows="15"></textarea></td>
	</tr>
</table>
<table>
<tr><td>学生类型：</td><td><input type="text" name="type" value="<?php echo $result->type;?>"/></td><td>状态:</td><td><input type="text" name="status" value="<?php echo $result->status;?>"/></td></tr>
<tr><td>班主任:</td><td><input type="text" name="headteacher" value="<?php echo $result1->deanteacher;?>" readonly style="background:#bcb9b9;border:1;"/></td><td>电话:</td><td><input type="text" id="tel" value="<?php echo $teacher->mobile; ?>" readonly style="background:#bcb9b9;border:1;"/></td></tr>
<tr><td>班长：</td><td><input type="text" name="monitor" value="<?php echo $result1->monitor;?>" readonly style="background:#bcb9b9;border:1;"/></td><td>电话：</td><td><input type="text" name="monitor" value="<?php echo $moniphone->mobilephone;?>" readonly style="background:#bcb9b9;border:1;"/></td></tr>
<tr><td>备注</td><td><textarea name="beizhu"><?php echo $result->beizhu." ".$result->first." ".$result->initial;;?></textarea></td></tr>
</table>
</div>
<div>
<h6>家庭信息</h6>
<table>
<tr><td>父亲姓名:</td><td><input type="text" name="fathername" value="<?php echo $result->fathername;?>"/></td><td>父亲电话:</td><td><input type="text" name="fathermobilephone" value="<?php echo $result->fathermobilephone;?>"/></td></tr>
<tr><td>母亲姓名:</td><td><input type="text" name="mathername" value="<?php echo $result->mathername;?>"/></td><td>母亲电话:</td><td><input type="text" name="mathermobilephone" value="<?php echo $result->mathermobilephone;?>"/></td></tr>
<tr><td>家庭地址:</td><td><textarea name="homeaddress"><?php echo $result->homeaddress;?></textarea></td><td>邮编:</td><td><input type="text" name="zipcode" value="<?php echo $result->zipcode;?>"/></td></tr>
</table>
</div>
<div>
<h6>奖惩情况</h6>
<table>
<tr >
<td>奖学金获得情况</td>
<td width="80%">
<?php
if(count($re2)>0)
{
foreach($re2 as $v)
{
$str.=$v->year."/".$v->xueqi." ".$v->scholarship.";<br>";
}
echo "<div>".$str."</div>";
}else
{
echo "<div>暂无数据</div>";
}
?>
</td>
</tr>
<tr>
<td>荣誉获得情况</td>
<td width="80%">
<?php
if(count($re3)>0)
{
foreach($re3 as $v)
{
$str2.=$v->year."/".$v->xueqi." ".$v->jibie.$v->honourname.";<br>";
}
echo "<div>".$str2."</div>";
}else
{
echo "<div>暂无数据</div>";
}
?>
</td>
</tr>
</table>
</div>
<div class="menu tc"><input type="submit" value=" 提交修改 "></div>
</form>
 <?php include("footer.php");?>
</body>
</html>
