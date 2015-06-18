<?php
require_once 'include/common.inc.php';
$jibie=array('院级','校级','市级','省级','国家级');
$sname = $_GET["sname"];
$sid = $_GET["sid"];
$major=$_GET["s_major"];
$grade=$_GET["s_year"];
$classn = $_GET["s_class"];
$sxuenian = $_GET["xuenian"];
$sxueqi = $_GET["xueqi"];
if($_GET['act'] == 'sel')
{
$id = $_GET['id'];
$sql = "select a.id as nid,a.*,b.name,b.sid,b.classid,c.id,c.name as classname,d.id,d.name as majorname from hour_vol a left join student_info b on a.sid = b.sid left join class c on b.classid = c.id left join major d on d.id = c.majorid WHERE a.id = $id ";
//$sql = "select a.id,a.*,b.sid,b.name,b.classid,c.id,c.name as classname from hour_vol a left join student_info b on on a.sid = b.sid left join class c on b.classid = c.id where a.id = $id ";
$result = $yiqi_db->get_row($sql);
}
$title="优秀志愿者信息修改";
include("header.php");
?>
<div class="menu tc">
<br><h2 style="text-align:center;display:inline-block">优秀志愿者信息修改</h2><br>
<br><a href="<?php echo "hour_vol.php?act=list&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi"; ?>">返回</a>
</div>
<form action="modify.php?act=hour_vol" method="post">
<input type="hidden" name="stu_id" value="<?php echo $result->sid;?>">
<input type="hidden" name="nid" value="<?php echo $result->nid;?>">
<table cellspacing="0" cellpadding="0" class="t_list list4">
</tr>
<tr><td align=center>学号：</td><td align=center><?php echo $result->sid;?></td></tr>
<tr><td align=center>姓名：</td><td align=center><?php echo $result->name; ?></td></tr>
<tr><td align=center>专业：</td><td align=center><?php echo $result->majorname; ?></td></tr>
<tr><td align=center>班级：</td><td align=center><?php echo $result->classname;?></td></tr>
<tr><td align=center>名称：</td><td align=center>优秀志愿者</td></tr>
<?php
	echo "<tr><td align=center>学年：</td><td align=center><select name='xuenian'>";
   foreach($yeardata as $v)
    {
	  $se = ($v==$result->xuenian)? " selected " : "";
	  echo "<option $se value='$v'>$v</option>";
    }
	echo "</select></td>";
?>
<tr><td align=center>学期：</td><td align=center><select name='xueqi'>
	<option <?php if($result->xueqi==1){echo "selected";} ?> value="1">第一学期</option>
	<option <?php if($result->xueqi==2){echo "selected";} ?> value="2">第二学期</option>
	</td></tr>
	</select>
<?php
	echo "<tr><td align=center>级别：</td><td align=center><select name='jibie'>";
   foreach($jibie as $v)
    {
	  $se = ($v==$result->jibie)? " selected " : "";
	  echo "<option $se value='$v'>$v</option>";
    }
	echo "</select></td>";
?>
<tr><td colspan=2 align=center><input type="submit" value="　提交修改　" /></td></tr>
</table>
</form>
<?php include("footer.php");?>
</body>
</html>