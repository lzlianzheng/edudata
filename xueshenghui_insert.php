<?php
 	
	require_once 'include/common.inc.php';
	$sql="select * from class";
	$classname=$yiqi_db->get_results($sql);
	if($_REQUEST['act']=='ins')
	{
		$now = date("Y-m-d H:i:s");
		$jieci=$_POST['jieci'];
		$zhiwu=$_POST['zhiwu'];
		$name=$_POST['name'];
		$cname=$_POST['cname'];
		$phone=$_POST['phone'];
		$sql="insert into xueshenghui (id,jieci,zhiwu,name,classname,phone,edittime) values (NULL,'$jieci','$zhiwu','$name','$cname','$phone','$now');";
		$a=$yiqi_db->query($sql);
		if($a)
		{
		echo "<script type=text/javascript>alert('添加成功');location.href='xueshenghui_insert.php';</script>";exit;
		}else
		{
		echo "<script type=text/javascript>alert('添加失败，请检查填写信息是否有误');window.history.go(-1);</script>";exit;
		}
	}
	$title="学生会信息录入";
	include("header.php");
?>
<script type="text/javascript" src="images/printarea.js"></script>
<div class="menu tc">
<a href="xueshenghui.php">返回   </a>
<h2 class="disin">添加分团委学生会信息</h2>
</div>
<form action="xueshenghui_insert.php" method="post">
<input type="hidden" name="act" value="ins">
<table  cellspacing="0" cellpadding="0" class="t_list list5">
		<tr>
		<td>届次</td><td><input type="text" name="jieci" value="" /></td>
		<td>职务</td><td><input type="text" name="zhiwu" value="" /></td>
		</tr>
		<tr>
		<td>姓名</td><td><input type="text" name="name"></td>
		<td>班级</td>
		<td>
		<select name="cname">
		<option value="">请选择</option>
		<?php 
		foreach($classname as $k=>$v)
		{
			echo "<option value='$v->name'>$v->name</option>";
		}
		?>
		</select>
		</td>
		</tr>
		<tr>
		<td>联系电话</td>
		<td><input type="text" name="phone"></td>
		<td></td>
		<td></td>
		</tr>
<tr><td colspan=4 align=center><input type="submit" value="  提  交  " /></td></tr>
</table>
</form>

      	<?php include("footer.php");?>
</body>
</html>
