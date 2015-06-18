<?php
require_once 'include/common.inc.php';
$id = $_REQUEST['id'];
$sname = $_GET["sname"];
$sid = $_GET["sid"];
$major=$_GET["s_major"];
$grade=$_GET["s_year"];
$classn = $_GET["s_class"];
$sxuenian = $_GET["xuenian"];
$sxueqi = $_GET["xueqi"];
$zhouci = $_GET["zhouci"];
$title="早操-个人修改";
include("header.php");
$sql = "select a.id as nid,a.*,b.name,b.sid,b.classid,c.id,c.name as classname,d.id,d.name as majorname from zaocao_personal a left join student_info b on a.sid = b.sid left join class c on b.classid = c.id left join major d on d.id = c.majorid WHERE a.id = $id ";
$result = $yiqi_db->get_row($sql);
$zhoucidata=$yiqi_db->get_results("select distinct zhouci from zaocao_personal order by zhouci asc");
?>
<script type="text/javascript" src="images/printarea.js"></script>
<div class="tc"><a href="<?php echo "zaocao_personal_record.php?act=list&sname=$sname&sid=$sid&s_major=$major&s_year=$grade&s_class=$classn&xuenian=$sxuenian&xueqi=$sxueqi&zhouci=$zhouci"; ?>">返回</a><br/></div>
<form action="modify.php" method="post">
<input type="hidden" name="act" value="zaocao_personal_save">
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
	  $se = ($v==$result->year)? " selected " : "";
	  echo "<option $se value='$v'>$v</option>";
    }
	echo "</select></td>";
?>
<tr><td align=center>学期：</td><td align=center><select name='xueqi'>
	<option <?php if($result->xueqi==1){echo "selected";} ?> value="1">第一学期</option>
	<option <?php if($result->xueqi==2){echo "selected";} ?> value="2">第二学期</option>
	</td></tr>
	</select>
<tr><td align=center>旷操日期：</td><td align=center><input type="text" name="kuangcaodate" value="<?php echo $result->kuangcaodate; ?>" /></td>
<tr><td align=center>迟到日期：</td><td align=center><input type="text" name="chidaodate" value="<?php echo $result->chidaodate; ?>" /></td>
<tr><td align=center>不认真日期：</td><td align=center><input type="text" name="burenzhendate" value="<?php echo $result->burenzhendate; ?>" /></td>
<tr><td align=center>周次：</td><td align=center><input type="text" name="zhouci" value="<?php echo $result->zhouci; ?>" /></td>
<tr><td align=center>记录人：</td><td align=center><input type="text" name="recorder" value="<?php echo $result->recorder; ?>" /></td>
<tr><td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
<?php include("footer.php");?>
</body>
</html>