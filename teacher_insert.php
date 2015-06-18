<?php
require_once 'include/common.inc.php';
$title="班主任信息录入";
include("header.php");
$action = $_POST["act"];
if($action == "save"){
	$now = date("Y-m-d H:i:s");
	$tid = $_POST["tid"];
	$name = $_POST["name"];
	$sex = $_POST["sex"];
	$birthday = $_POST["birthday"];
	$zhengzhi = $_POST["zhengzhi"];
	$xueli = $_POST["xueli"];
	$zhicheng = $_POST["zhicheng"];
	$worktime = $_POST["worktime"];
	$bumen = $_POST["bumen"];
	$zhiwu = $_POST["zhiwu"];
	$zhuanjian = $_POST["zhuanjian"];
	$mobile = $_POST["mobile"];
	if($tid){
		$datenow = date("Y-m-d H:i:s");
		$sql = "insert into cteacher (`id`,`name`,`tid`,`sex`,`birthday`,`zhengzhi`,`xueli`,`zhicheng`,`worktime`,`bumen`,`zhiwu`,`zhuanjian`,`mobile`,`addtime`) values (NULL,'$name',$tid,'$sex','$birthday','$zhengzhi','$xueli','$zhicheng','$worktime','$bumen','$zhiwu','$zhuanjian','$mobile','$now')";
		$result = $yiqi_db->query($sql);
		if($result == 1)
			ShowMsg("添加成功","teacher_insert.php");
		else
			ShowMsg("添加失败","back");
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
<a href="cteacher.php" ss="fl">返回列表</a>　
<h2 class="disin">添加班主任基本信息</h2>　　　　
</div>
<form action="" method="post">
<input type="hidden" name="act" value="save" />
<table cellspacing="0" cellpadding="0" class="t_list list5">
<tr>
	<td class="w10">姓名</td>
	<td class="w40"><input type="text" name="name"/></td>
	<td class="w10">工号</td>
	<td class="w40"><input type="text" name="tid"/></td>
</tr>
<tr>
	<td>性别</td>
	<td>
	<select name="sex">
	<option value="男">男</option>
	<option value="女">女</option>
	</select>
	</td>
	<td>生日</td>
	<td><input type="text" name="birthday" /></td>
</tr>
<tr>
	<td>政治面貌</td>
	<td><input type="text" name="zhengzhi" /></td>
	<td>学历</td>
	<td><input type="text" name="xueli"/></td>
</tr>
<tr>
	<td>职称</td>
	<td><input type="text" name="zhicheng"/></td>
	<td>聘任时间</td>
	<td><input type="text" name="worktime"/></td>
</tr>
<tr>
	<td>现任部本</td>
	<td><input type="text" name="bumen"/></td>
	<td>职务级别</td>
	<td><input type="text" name="zhiwu"/></td>
</tr>
<tr>
	<td>专兼职</td>
	<td>
	<select name="zhuanjian">
	<option value="专职">专职</option>
	<option value="兼职">兼职</option>
	</select>
	</td>
	<td>联系方式</td>
	<td><input type="text" name="mobile"/></td>
</tr>
<tr>
	<td colspan=4 align=center><input type="submit" value="　提  交　" /></td>
</tr>
</table>
</form>
      	<?php include("footer.php");?>

</body>
</html>
