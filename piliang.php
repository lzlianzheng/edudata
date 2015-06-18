
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="images/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="D:/xampp/htdocs/uploadify_jb51/jb51.net/uploadify.css">  
<script type="text/javascript" src="images/jquery-1.6.1.min.js"></script>
<script type="text/javascript"   src="D:/xampp/htdocs/uploadify_jb51/jb51.net/jquery.uploadify-3.1.min.js"></script>  
<script type="text/javascript">
$(document).ready(function(){
	$("select[name=s_major]").change(function(){
		$.get("jsondata.php?type=stu&mid="+$(this).val(),null,function(data){
			$("select[name=s_class]").html(data);
		});
	});
});
</script>
<body>
<div class="mainbody">
<div class="menu tc">
　

<form action="invent.php" method="get" class="disin">
<?php
	echo "专业 <select name='s_major'><option value=''>请选择</option>";
	$majorpara=globalpara("major");
	foreach($majorpara as $k=>$v){
		echo "<option value='$k'>$v</option>";
	}
	echo "</select>";
	echo "班级 <select name='s_class'><option value=''>请选择</option>";
	$classpara=globalpara("class");
	
	foreach($classpara as $k=>$x){
		echo "<option value='$x'>$x</option>";
		
	}
	echo "</select>";
?>
入学年 起<input type="text" name="syear" size=10 value="<?php echo $syear; ?>" />　止<input type="text" name="eyear" size=10 value="<?php echo $eyear; ?>" />
学期<select name='xueqi'><option value=''>请选择</option>";
	<option value="1">第一学期</option>
	<option value="2">第二学期</option>
	</select>
<input type="submit" value="查询" id="submit" />　　　　　
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list4">
<tr>
	<td>班级</td>
	<td>姓名</td>
	<td>学号</td>
	<td>学年</td>
	<td>学期</td>	
	<td>发明内容</td>
	<td>获得时间</td>
	<td>授予单位</td>
</tr>
<?php
if(count($result) > 0){
	foreach($result as $v){
		echo "<tr>
			<td>$v->class</td>
			<td>$v->name</td>
			<td>$v->sid</td>
			<td>$v->year</td>
			<td>$v->xueqi</td>
			<td>$v->content</td>
			<td>$v->time</td>
			<td>$v->unit</td>
		</tr>";
	}
}
?>
</table>
</div>
</body>
</html>