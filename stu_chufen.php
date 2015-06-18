<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';	

	$jibie = $_REQUEST["jibie"];
	$table = stu_chufen;
	$sql="select a.id as nid,a.type,a.reason,a.wenjianhao,a.chufendata,b.sid,b.name,c.name as classname ,d.id,d.uid from stu_chufen a left join student_info b on a.sid=b.sid left join class c on b.classid=c.id left join major d on c.majorid = d.id where 1";
	$sql .= ($jibie) ? " and a.type = '$jibie' " : "";
	include("sqlresult.php");
if($_GET["act"] == "out"){
	header("Content-type: application/vnd.ms-excel; charset=gb2312");
	Header("Content-Disposition: attachment; filename=stu_chufen.xls");
	$tnow = "<td>班级</td><td>学号</td><td>姓名</td><td>处分级别</td><td>处分原因</td><td>文件号</td><td>处分时间</td>";
	echo "<table border=1><tr>".$tnow."</tr>\n";
	if(count($result) > 0){
	$outc="";
		foreach($result as $k=>$v){		
				$outc .= "<tr>
							<td>$v->classname</td>
							<td>$v->sid</td>
							<td>$v->name</td>
							<td>$v->type</td>
							<td>$v->reason</td>
							<td>$v->wenjianhao</td>
							<td>$v->chufendata</td>
						 </tr>";
		}
		echo $outc;
	}
	echo  "</table>";
}
else{
$title="违纪管理";
include("header.php");
?>
<script type="text/javascript">
$(document).ready(function(){
	$("select[name=s_major]").change(function(){
		$.get("jsondata.php?type=class&mid="+$(this).val(),null,function(data){
			$("select[name=s_class]").html(data);
		});
	});
});
</script>
</head>
<div class="menu tc">
<a href="data_in.php?name=stu_chufen">批量导入学生处分</a>　　
<a href="chufen_s.php">普通录入</a>	　　
<a href="<?php echo "stu_chufen.php?act=out&s_major=$mid&s_class=$cid&nianji=$nianji&stuname=$stuname&stuid=$stuid&jibie=$jibie"; ?>">导出数据</a><br/>
<form action="stu_chufen.php" method="get" class="disin">
<input type="hidden" name="act" value="list">
<?php
	require_once 's_year_class.php';
	require_once 's_name_sid.php';
?>
  处分类型<input type="text" name="jibie" value="<?php echo $jibie; ?>" size="10">
  	<input type="submit" value="查询" id="submit" />
</form>
</div>
<form  method="post">
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>选择</td>
	<td>班级</td>
	<td>学号</td>
	<td>姓名</td>	
	<td>处分类型</td>
	<td>处分原因</td>
	<td>文件号</td>
	<td>处分时间</td>
	<td>撤销日期</td>
	<td colspan="2">操作</td>
</tr>
<?php
	if($_REQUEST['act'] =='list')
	{
if(count($result) > 0){
	foreach($result as $v){
		echo "<tr>
			<td><input id=\"slt$v->nid\" type=\"checkbox\" name=\"chk[]\" value=\"$v->nid\" /></td>
			<td>$v->classname</td>
			<td>$v->sid</td>
			<td>$v->name</td>
			<td>$v->type</td>
			<td>$v->reason</td>
			<td>$v->wenjianhao</td>
			<td>$v->chufendata</td>
			<td>$v->chexiaodata</td>
			<td><a href='chufen_d.php?id=$v->id'>修改</a></td>
			<td><a href='scholar_del.php?act=chufen_del&id=$v->id&s_major=$mid&s_class=$cid&nianji=$nianji&stuname=$stuname&stuid=$stuid&jibie=$jibie'>删除</a></td>
		</tr>";
	}
}		else{echo"<tr><td colspan='12'>暂无记录</td></tr>";}
	}	
	else{echo"<tr><td colspan='12'>请输入筛选条件</td></tr>";}
?>
</table>
	<br>
	<div class="fl" style="text-indent:20px;">
		<input id="slt" type="checkbox"/>&nbsp;&nbsp;
		<select name="stat">
		<option value="">批量应用</option>
		<option value="del">删除</option>
		</select>&nbsp;
		<input type="submit" class="subtn" value="提交" onclick="if(!confirm('确认执行相应操作?')) return false;"/>
	</div>
	</form>
	</div>
      	<?php include("footer.php");?>
</body>
</html>
<?php
}
?>
