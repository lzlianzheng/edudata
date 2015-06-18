<?php
require_once 'include/common.inc.php';
?>

<html >
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
<input type="hidden" name="act" value="org_class_update">
	<table cellspacing="0" cellpadding="0" class="t_list list4">
		<tr>
			<td align=center>组织类别		<input type="text" name="class"/></td>
		</tr>
		<tr>
			<td colspan=4 align=center><input type="submit" value="　确认增加　" /></td>
		</tr>
	</table>
</form>
</div>
</body>
</html>