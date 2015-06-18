<?php
require_once 'include/common.inc.php';
$title ="班级详细信息";
include("header.php");
$syear = $_GET["syear"];
$eyear = $_GET["eyear"];
$cid = $_GET["id"];
$sql = "select a.*,b.mobile as m1,c.mobilephone as m2 from class a left join cteacher b on a.deanteacher=b.name left join student_info c on a.monitor=c.name where a.id='$cid'";
$cname = $_GET["cname"];
if($cname)
	$sql = "select a.*,b.mobile as m1,c.mobilephone as m2 from class a left join cteacher b on a.deanteacher=b.name left join student_info c on a.monitor=c.name where a.name='$cname'";
$v = $yiqi_db->get_row($sql);
$majorpara = globalpara("major");
$majorname = $majorpara[$v->majorid];
$csex = $yiqi_db->get_results("select count(sid) as c ,sex from student_info where classid='$v->id' and status = '在读' and type != '插班生' group by sex order by sex");
//print_r($csex);
$c_female = $csex[0]->c;
$c_male = $csex[1]->c;
$c_total = $c_female + $c_male;
$chaban = $yiqi_db->get_row("select count(sid) as c from student_info where type='插班生' and classid='$v->id'");
$nation = $yiqi_db->get_row("select count(sid) as c from student_info where nationid!='1' and classid='$v->id'");
$action = $_POST["action"];
if($action == "save"){
	$cid = $_POST["cid"];
	$deanteacher = ($_POST["deanteacher"])? $_POST["deanteacher"] : $v->deanteacher;
	$monitor = ($_POST["monitor"])? $_POST["monitor"] : $v->monitor;
	$classroom = ($_POST["classroom"])? $_POST["classroom"] : $v->classroom;
	$capacity = ($_POST["capacity"])? $_POST["capacity"] : $v->capacity;
	if($cid){
		$datenow = date("Y-m-d H:i:s");
		$sql = "update class set deanteacher='$deanteacher',monitor='$monitor',classroom='$classroom',capacity='$capacity',edittime='$datenow' where id='$cid'";
		$result = $yiqi_db->query($sql);
		if($result == 1)
			ShowMsg("修改成功","class_d.php?id=$cid");
		else
			ShowMsg("修改失败","back");
	}
}
?>
<script type="text/javascript" src="images/printarea.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	show = 0;
	$("#print").click(function(){
		if(show == 1)
		$("#printarea").printArea();
	});
	$("#showlist").click(function(){
		show = 1 - show;
		if(show == 1){
			$("#printarea").load("classlist.php?cid=<?php echo $cid; ?>");
			$(this).val("隐藏学生列表");
		}else{
			$("#printarea").html("");
			$(this).val("显示学生列表");
		}
	});
});
</script>

<div class="tc"><a href="<?php echo "class.php?act=sel&syear=$syear&eyear=$eyear"; ?>">返回列表</a><br/><form action="" method="get">
输入班级名称查询：<input type="text" name="cname" value="<?php echo $cname; ?>" />
<input type="submit" value="查询" id="submit" />
</form></div>
<form action="" method="post">
<input type="hidden" name="action" value="save" />
<input type="hidden" name="cid" value="<?php echo $v->id; ?>" />
<table cellspacing="0" cellpadding="0" class="t_list list4">
<tr>
	<td class="w10">班级</td>
	<td class="w40"><?php echo $v->name; ?></td>
	<td class="w10"></td>
	<td class="w40"></td>
</tr>
<tr>
	<td>专业</td>
	<td><?php echo $majorname; ?></td>
	<td>入学年</td>
	<td><?php echo $v->year; ?> 年</td>
</tr>
<tr>
	<td>班主任</td>
	<td><input type="text" name="deanteacher" value="<?php echo $v->deanteacher; ?>" /></td>
	<td>电话</td>
	<td><?php echo $v->m1; ?></td>
</tr>
<tr>
	<td>班长</td>
	<td><input type="text" name="monitor" value="<?php echo $v->monitor; ?>" /></td>
	<td>电话</td>
	<td><?php echo $v->m2; ?></td>
</tr>
<tr>
	<td>教室</td>
	<td><input type="text" name="classroom" value="<?php echo $v->classroom; ?>" /></td>
	<td>容纳人数</td>
	<td><input type="text" name="capacity" value="<?php echo $v->capacity; ?>" /> （实际 <?php echo $c_total; ?> 人）</td>
</tr>
<tr>
	<td>男生人数</td>
	<td><?php echo $c_male; ?></td>
	<td>女生人数</td>
	<td><?php echo $c_female; ?></td>
</tr>
<tr>
	<td>插班生人数</td>
	<td><?php echo $chaban->c; ?></td>
	<td>民族生人数</td>
	<td><?php echo $nation->c; ?></td>
</tr>
<tr>
	<td>总人数</td>
	<td><?php echo $c_total; ?></td>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>

<div class="tc ptop"><input type="button" id="showlist" value=" 显示班级名单 "  />　　　<input type="button" value=" 打印名单 " id="print" /><br/>
友情提示：打印前请先将浏览器默认的页眉页脚去掉。（在浏览器窗口顶部点击 文件->页面设置 ，修改相应选项。）
</div>
<div id="printarea">
</div>
 <?php include("footer.php");?>
</body>
</html>
