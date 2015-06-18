<?php
require_once 'include/common.inc.php';
$jibie=array('国家级','省级','市级','校级','院级','协会','其他');
$prizegrade=array('特等奖','一等奖','二等奖','三等奖','鼓励奖','军训优秀学员');
$leibie=array('体育活动类','文化艺术类','学科竞赛类');
$sname = $_GET["sname"];
$sid = $_GET["sid"];
$major=$_GET["s_major"];
$grade=$_GET["s_year"];
$classn = $_GET["s_class"];
$sxuenian = $_GET["xuenian"];
$sxueqi = $_GET["xueqi"];
$id = $_REQUEST['id'];
$sql = "select * from sbisai_prize where id = $id";
$data = $yiqi_db->get_row($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="images/main.css" rel="stylesheet" type="text/css" media="" />
<link href="images/print2.css" rel="stylesheet" type="text/css" media="print" />
<script type="text/javascript" src="images/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="images/printarea.js"></script>
<body>
<div class="mainbody">
<div class="tc"><a href="<?php echo "bisai_prize.php?act=sel&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi"; ?>">返回</a><br/>
</div>
<form action="modify.php" method="post">
<input type="hidden" name="act" value="bisai">
<input type="hidden" name="id" value="<?php echo $data->id;?>">
<table cellspacing="0" cellpadding="0" class="t_list list4">

</tr>

<tr>
	<td align=center>姓名：</td><td align=center><?php echo $data->name; ?></td>
	<td align=center>学号：</td><td align=center><?php echo $data->sid;?></td>
</tr>
<tr>

	<td align=center>班级：</td><td align=center><?php echo $data->class;?></td>
<?php
	echo "<td align=center>获奖类别：</td><td align=center><select name='leibie'>";
   foreach($leibie as $v)
    {
	  $se = ($v==$data->leibie)? " selected " : "";
	  echo "<option $se value='$v'>$v</option>";
    }
	echo "</select></td>";
?>
</tr>
<?php
	echo "<tr><td align=center>学年：</td><td align=center><select name='xuenian'>";
   foreach($yeardata as $v)
    {
	  $se = ($v==$data->xuenian)? " selected " : "";
	  echo "<option $se value='$v'>$v</option>";
    }
	echo "</select></td>";
?>
	<td align=center>学期：</td><td align=center><select name='xueqi'>
	<option <?php if($data->xueqi==1){echo "selected";} ?> value="1">第一学期</option>
	<option <?php if($data->xueqi==2){echo "selected";} ?> value="2">第二学期</option>
	</td></tr>
	</select>
<tr>
	<td align=center>获奖日期:</td>
	<td align=center><input type="text" name="prizedate" value="<?php echo $data->prizedate; ?>" /></td>
<?php
	echo "<td align=center>获奖级别：</td><td align=center><select name='level'>";
   foreach($jibie as $v)
    {
	  $se = ($v==$data->level)? " selected " : "";
	  echo "<option $se value='$v'>$v</option>";
    }
	echo "</select></td>";
?>
</tr>
<tr>
	<td align=center>获奖名称:</td>
	<td align=center><input type="text" name="prizename" value="<?php echo $data->prizename; ?>" /></td>
<?php
	echo "<td align=center>获奖名次：</td><td align=center><select name='prizegrade'>";
   foreach($prizegrade as $v)
    {
	  $se = ($v==$data->prizegrade)? " selected " : "";
	  echo "<option $se value='$v'>$v</option>";
    }
	echo "</select></td>";
?>
</tr>
<tr>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
</div>
</body>
</html>