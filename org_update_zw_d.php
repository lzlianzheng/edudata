<?php
require_once 'include/common.inc.php';
$id = $_GET['id'];
$sql="select * from org_style";
$result=$yiqi_db->get_results($sql);
?>

<html>
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="images/main.css" rel="stylesheet" type="text/css" media="" />
<link href="images/print2.css" rel="stylesheet" type="text/css" media="print" />
<script type="text/javascript" src="images/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="images/printarea.js"></script>
<body>
<div class="mainbody">
<div class="tc"><a href="org_update.php?act=sel">返回列表</a><br/></div>
<form action="modify.php" method="post">
<input type="hidden" name="act" value="org_zhiwu_update">

	<table cellspacing="0" cellpadding="0" class="t_list list4">
		<tr>
			
			<td>组织类别</td>
	<td><select name="classid">
	<?php
	foreach($result as $v){
	$se = ($v->id == $id)? " selected " : "";
	echo "<option $se value=$v->id>$v->class</option>";
	}
	?></select></td>
			<td>职务</td>
			<td><input type="text" name="zhiwu"/></td>
		</tr>
		<tr>
			<td colspan=4 align=center><input type="submit" value="　确认增加　" /></td>
		</tr>
	</table>
</form>
</div>
</body>
</html>