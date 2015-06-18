<?php
require_once 'include/common.inc.php';
$title="班主任信息详情";
include("header.php");
$id = $_GET["id"];
if($id)
	$sql = "select * from cteacher where id='$id'";
$cid = $_GET["s_class"];
if($cid)
	$sql = "select a.* from cteacher a,class b where a.name=b.deanteacher and b.id='$cid'";
$tname = $_GET["tname"];
if($tname)
	$sql = "select * from cteacher where name='$tname'";
$v = $yiqi_db->get_row($sql);
$action = $_POST["action"];
if($action == "save"){
	$t_id = $_POST["t_id"];
	$name = ($_POST["name"])? $_POST["name"] : $v->name;
	$birthday = ($_POST["birthday"])? $_POST["birthday"] : $v->birthday;
	$xueli = ($_POST["xueli"])? $_POST["xueli"] : $v->xueli;
	$zhicheng = ($_POST["zhicheng"])? $_POST["zhicheng"] : $v->zhicheng;
	$bumen = ($_POST["bumen"])? $_POST["bumen"] : $v->bumen;
	$zhiwu = ($_POST["zhiwu"])? $_POST["zhiwu"] : $v->zhiwu;
	$mobile = ($_POST["mobile"])? $_POST["mobile"] : $v->mobile;
	if($t_id){
		$datenow = date("Y-m-d H:i:s");
		$sql = "update cteacher set `name`='$name',`birthday`='$birthday',`xueli`='$xueli',`zhicheng`='$zhicheng',`bumen`='$bumen',`zhiwu`='$zhiwu',`mobile`='$mobile',addtime='$datenow' where id='$t_id'";
		echo $sql;
		$result = $yiqi_db->query($sql);
		if($result == 1)
			ShowMsg("修改成功","cteacher_d.php?id=$t_id");
		else
			ShowMsg("修改失败","back");
	}
}
?>
<script type="text/javascript">
$(document).ready(function(){
	$("select[name=s_class]").children("option").each(function(){
		if($(this).val() == "<?php echo $cid; ?>")
			$(this).attr("selected",true);
		else
			$(this).attr("selected",false);
	});
});
</script>

<div class="tc">
<a href="cteacher.php"ss="fl">返回列表</a>　　　　　
<form action="cteacher_d.php" method="get" class="disin">
选择班级查询：<select name='s_class'><option value=''>请选择</option>";
<?php
	$classpara=globalpara("class");
	foreach($classpara as $k=>$x){
		echo "<option value='$k'>$x</option>";
	}
?>
</select>
<input type="submit" value="查询" id="submit" />　　　　　
</form>
<form action="cteacher_d.php" method="get" class="disin">
输入姓名查询：<input type="text" name="tname" value="<?php echo $tname; ?>" />
<input type="submit" value="查询" id="submit" />
</form>
</div>
<form action="" method="post">
<input type="hidden" name="action" value="save" />
<input type="hidden" name="t_id" value="<?php echo $v->id; ?>" />
<table cellspacing="0" cellpadding="0" class="t_list list4">
<tr>
	<td class="w10">姓名</td>
	<td class="w40"><input type="text" name="name" value="<?php echo $v->name; ?>" /></td>
	<td class="w10">工号</td>
	<td class="w40"><?php echo $v->tid; ?></td>
</tr>
<tr>
	<td>性别</td>
	<td><?php echo $v->sex; ?></td>
	<td>生日</td>
	<td><input type="text" name="birthday" value="<?php echo $v->birthday; ?>" /></td>
</tr>
<tr>
	<td>政治面貌</td>
	<td><?php echo $v->zhengzhi; ?></td>
	<td>学历</td>
	<td><input type="text" name="xueli" value="<?php echo $v->xueli; ?>" /></td>
</tr>
<tr>
	<td>职称</td>
	<td><input type="text" name="zhicheng" value="<?php echo $v->zhicheng; ?>" /></td>
	<td>聘任时间</td>
	<td><?php echo $v->worktime; ?></td>
</tr>
<tr>
	<td>现任部门</td>
	<td><input type="text" name="bumen" value="<?php echo $v->bumen; ?>" /></td>
	<td>职务级别</td>
	<td><input type="text" name="zhiwu" value="<?php echo $v->zhiwu; ?>" /></td>
</tr>
<tr>
	<td>专兼职</td>
	<td><?php echo $v->zhuanjian; ?></td>
	<td>联系方式</td>
	<td><input type="text" name="mobile" value="<?php echo $v->mobile; ?>" /></td>
</tr>
<tr>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
<?php include("footer.php");?>
</body>
</html>
