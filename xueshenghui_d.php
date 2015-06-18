<?php
require_once 'include/common.inc.php';

$id = $_GET["id"];
if($id)
	$sql = "select * from xueshenghui where id='$id'";
$v = $yiqi_db->get_row($sql);
$action = $_POST["action"];
if($action == "save"){
	$id = $_POST["t_id"];
	$jieci=($_POST["jieci"])?$_POST["jieci"]:$v->jieci;
	$zhiwu=($_POST["zhiwu"])?$_POST["zhiwu"]:$v->zhiwu;
	$name = ($_POST["name"])? $_POST["name"] : $v->name;
	$classname= ($_POST["classname"])?$_POST["classname"] :$v->classname;
	$phone =($_POST["phone"])?$_POST["phone"]:$v->phone;
	if($id){
		$datenow = date("Y-m-d H:i:s");
		$sql = "update xueshenghui set jieci='$jieci',zhiwu='$zhiwu',name='$name',classname='$classname',phone='$phone',edittime='$datenow' where id=$id ";
		$result = $yiqi_db->query($sql);
		if($result == 1)
			ShowMsg("修改成功","xueshenghui_d.php?id=$t_id");
		else
			ShowMsg("修改失败","back");
	}
}
$title="学生会成员详细信息修改";
include("header.php");
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
<a href="xueshenghui.php" ss="fl">返回列表</a>　　　　　
</div>
<form action="" method="post">
<input type="hidden" name="action" value="save" />
<input type="hidden" name="t_id" value="<?php echo $v->id; ?>" />
<table cellspacing="0" cellpadding="0" class="t_list list4">
<tr>
	<td class="w10">届次</td>
	<td class="w40"><input type="text" name="jieci" value="<?php echo $v->jieci; ?>" /></td>
	<td class="w10">职务</td>
	<td class="w40"><input type="text" name="zhiwu" value="<?php echo $v->zhiwu; ?>" /></td>
</tr>
<tr>
	<td>姓名</td>
	<td><input type="text" name="name" value="<?php echo $v->name; ?>" /></td>
	<td>班级</td>
	<td><input type="text" name="classname" value="<?php echo $v->classname; ?>" /></td>
</tr>
<tr>
	<td>联系电话</td>
	<td><input type="text" name="phone" value="<?php echo $v->phone; ?>" /></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td colspan=4 align=center><input type="submit" value="　提交修改　" /></td>
</tr>
</table>
</form>
<?php include("footer.php");?>
</body>
</html>
