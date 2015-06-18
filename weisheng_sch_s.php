<?php
require_once 'include/common.inc.php';
/*if($_REQUEST['act'] == 'weisheng_sch_sel')
{
	$mid=$_GET["s_major"];
	$cid = $_GET["s_class"];
	$sch_xueqi=$_GET["sch_xueqi"];
	$sch_year=$_GET["sch_year"];
	$sql="select * from class where 1";
	if($mid)
	{
	$sql .=" and majorid=$mid";
	}
	if($cid)
	{
	$sql .=" and id=$cid";
	}
	$result=$yiqi_db->get_results($sql);
}*/
$title="校级卫生周检查录入";
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

function scholar_in(){
	year = $("select[name=sch_year]").val();
	xueqi = $("select[name=sch_xueqi]").val();
	if(!year || !xueqi){
		alert("请输入卫生周检查所属学年/学期");
	}else{
		$.get("./scholar_insert.php?act=weisheng_sch_save&year="+year+"&xueqi="+xueqi,$("#sl_ws").serialize(),function(data){
						alert(data);
						$("#sl_ws")[0].reset();
		});
	}
	return false;
}
</script>
<div class="menu tc">
　
<a href="weisheng_score.php">返回</a>　
<!--form action="weisheng_sch_s.php" method="get" class="disin">
<input type="hidden" name="act" value="weisheng_sch_sel">
<input type="submit" value="查询" id="submit" /-->　　　　　

所属学年<select name='sch_year'><option value=''>请选择</option>
	<?php
	foreach($yeardata as $k=>$v)
	{
	 if($sch_year == $v)
	  echo "<option vlaue='$v' selected>$v</option>";
	 else
	  echo "<option vlaue='$v'>$v</option>";
	}
	?>
	</select>
学期<select name='sch_xueqi'><option value=''>请选择</option>
	<option <?php if($sch_xueqi==1) echo "selected"; ?> value="1">第一学期</option>
	<option <?php if($sch_xueqi==2) echo "selected"; ?> value="2">第二学期</option>
	</select>
<!--/form-->
</div>

<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<!--td>班级</td-->
	<td>周次</td>	
	<td>宿舍楼</td>
	<td>宿舍号</td>
	<td>得分</td>
	<td>检查日期</td>
	<td>记录人</td>	
	<td>操作</td>
</tr>
<?php
//if(count($result) > 0){
//	foreach($result as $v){
		echo "<form  id='sl_ws' method='get' onsubmit='scholar_in();return false;'>";
//			<input type='hidden' name='cid' value='$v->id'/>
//			<td><input type='hidden' name='classname' value='$v->name'>$v->name</td>
		echo	"<tr><td><input type='text' name='zhouci' value='' size=5 /></td>
			<td>学<input type='text' name='dormlou' value='' size=10 /></td>
			<td><input type='text' name='dormnum' value='' size=10 /></td>
			<td>
				<select name='score'><option value=''>请选择</option>
					<option value='优秀'>优秀</option>
					<option value='不合格'>不合格</option>
				</select>
			</td>
			<td><input type='text' name='checkdate' value='' size=15 /></td>
			<td><input type='text' name='recorder' value='' size=15 /></td>
			<td><input type='submit' value='写入'/></td></tr></form>";
//	}
	
//}
?>
</table>
      	<?php include("footer.php");?>
</body>
</html>
