<?php
require_once 'include/common.inc.php';
if($_REQUEST['act']=='update_class'){
	$org_name = $_REQUEST['org_name'];
$sql="select id,class as name from org_style where class = '$org_name'";
$result=$yiqi_db->get_row($sql);
//print_r($org_name);
}
if($_REQUEST['act']=='update_zhiwu'){
	$org_name = $_REQUEST['org_name'];
	$sql="select * from org_style_d where name = '$org_name'";
	$result1=$yiqi_db->get_row($sql);
	//print_r($result1);
}
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
<?php
	if($result){
?>
	<input type="hidden" name="class_id" value="<?php echo $result->id; ?>" />
	<input type="hidden" name="act" value="org_modify_class">
	<table cellspacing="0" cellpadding="0" class="t_list list4">
		<tr>
			
			<td>名称</td>
			<td><input type="text" name="mingcheng" value="<?php echo $result->name; ?>" /></td>
		</tr>
		<tr>
			<td colspan=4 align=center><input type="submit" value="　确认修改　" /></td>
		</tr>
	</table> 
<?php
	};
	if($result1){
?>	
	<input type="hidden" name="zhiwu_id" value="<?php echo $result1->id; ?>" />
	<input type="hidden" name="act" value="org_modify_zhiwu">
	<table cellspacing="0" cellpadding="0" class="t_list list4">
		<tr>
			
			<td>名称</td>
			<td><input type="text" name="mingcheng" value="<?php echo $result1->name; ?>" /></td>
		</tr>
		<tr>
			<td colspan=4 align=center><input type="submit" value="　确认修改　" /></td>
		</tr>
	</table> 
<?php
	}
?>
</form>
</div>
</body>
</html>