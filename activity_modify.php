<?php
require_once 'include/common.inc.php';
$sname = $_GET["sname"];
$sid = $_GET["sid"];
$major=$_GET["s_major"];
$grade=$_GET["s_year"];
$classn = $_GET["s_class"];
$sxuenian = $_GET["xuenian"];
$sxueqi = $_GET["xueqi"];
$title="活动参与修改";
include("header.php");
$jibie=array('国家级','省级','市级','校级','院级','协会','其他');
$id = $_REQUEST['id'];
$sql = "select a.id as nid,a.*,b.name,b.sid,b.classid,c.id,c.name as classname,d.id,d.name as majorname from activity_join a left join student_info b on a.sid = b.sid left join class c on b.classid = c.id left join major d on d.id = c.majorid WHERE a.id = $id ";
$result = $yiqi_db->get_row($sql);
?>
<script type="text/javascript" src="images/printarea.js"></script>
<div class="tc"><a href="<?php echo "activity.php?act=list&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi"; ?>">返回</a><br/></div>
<form action="modify.php" method="post">
<input type="hidden" name="act" value="activity">
<input type="hidden" name="nid" value="<?php echo $result->nid;?>">
<table cellspacing="0" cellpadding="0" class="t_list list4">
</tr>
<tr><td align=center>学号：</td><td align=center><?php echo $result->sid;?></td></tr>
<tr><td align=center>姓名：</td><td align=center><?php echo $result->name; ?></td></tr>
<tr><td align=center>专业：</td><td align=center><?php echo $result->majorname; ?></td></tr>
<tr><td align=center>班级：</td><td align=center><?php echo $result->classname;?></td></tr>
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
	echo "<tr><td align=center>测评等级：</td><td align=center><select name='jibie'>";
   foreach($jibie as $v)
    {
	  $se = ($v==$result->jibie)? " selected " : "";
	  echo "<option $se value='$v'>$v</option>";
    }
	echo "</select></td>";
?>
	</tr><td align=center>活动名称</td><td align=center><input type="text" name="act_name" value="<?php echo $result->act_name; ?>" /></td><tr>
	<tr><td align=center>活动内容</td><td align=center><input type="text" name="content" value="<?php echo $result->content; ?>" /></td></tr>
	<tr><td align=center>活动时间</td><td align=center><input type="text" name="act_date" value="<?php echo $result->act_date; ?>" /></td></tr>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
<?php include("footer.php");?>
</body>
</html>