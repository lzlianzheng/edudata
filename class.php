<?php
require_once 'include/common.inc.php';
require_once 'getuid.php';
$title="班级信息维护";
include("header.php");
/*$curpage = $_GET["p"];
$curpage = (isset($curpage) && is_numeric($curpage)) ? $curpage : 1;
if($curpage<1)
	$curpage=1;

$sql = "select a.*,b.mobile as m1,c.mobilephone as m2,d.id as did,d.uid from class a left join cteacher b on a.deanteacher=b.name left join student_info c on a.monitor=c.name and a.id=c.classid inner join major d on a.majorid = d.id and d.uid = $uid ";
//print($sql);
//$orderby = " order by edittime desc ";	
$resultcount = $yiqi_db->get_row("select count(id) as c from (select a.*,b.mobile as m1,c.mobilephone as m2,d.id as did,d.uid from class a left join cteacher b on a.deanteacher=b.name left join student_info c on a.monitor=c.name and a.id=c.classid inner join major d on a.majorid = d.id and d.uid = $uid )a");
$total1 = (int)$resultcount->c;
$take = 50;
$totalpage = (int)($total1 % $take == 0 ? $total1 / $take : $total1 / $take + 1);
$curpage = ($totalpage == 0)? 1 : (($curpage > $totalpage)? $totalpage : $curpage) ;
$skip = ($curpage - 1) * $take;
$result = $yiqi_db->get_results($sql ." limit $skip,$take ");
//print_r($result);
$majorpara = globalpara("major");
$url = "class.php?";
$pagerhtml = pager($totalpage,$curpage,$url);*/
if($_REQUEST['act']=='sel')
{
	$syear = $_GET["syear"];
	$eyear = $_GET["eyear"];
	$sql = "select a.*,b.mobile as m1,c.mobilephone as m2,d.id as did,d.uid,d.name as majorname from class a left join cteacher b on a.deanteacher=b.name left join student_info c on a.monitor=c.name and a.id=c.classid inner join major d on a.majorid = d.id and d.uid = $uid ";
	$sql2 = "select id from class where 1";
	$sql2 .= ($syear)? " and year>='$syear' " : "";
	$sql2 .= ($eyear)? " and year<='$eyear' " : "";
	if($syear || $eyear)
		$sql .= " where a.id in ($sql2) ";
	$result=$yiqi_db->get_results($sql);
}
if($_REQUEST['act']=='delete')
{
	$cid = $_GET["cid"];
	$syear = $_GET["syear"];
	$eyear = $_GET["eyear"];
	$sql="delete from class where id=$cid";
	$result=$yiqi_db->query($sql);
	//echo "<script type=text/javascript>alert('删除成功');window.history.go(-1);</script>";exit;
	if($result==1)
			ShowMsg("删除成功","class.php?act=sel&syear=$syear&eyear=$eyear");
	else
			ShowMsg("操作失败","back");
}
$actstat = $_POST["stat"];
if($actstat)
{
    $idarr = $_POST["chk"];
	if(count($idarr) > 0)
	{
		foreach($idarr as $id)
		{
			if(is_numeric($id))
			{
				$v = str_replace("v","",$actstat);
				$sql = "update class set status='$v' where id='$id'";
				$yiqi_db->query(CheckSql($sql));
			}
		}
		ShowMsg("操作成功");
	}
}
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#pagego_do").click(function(){
		v = parseInt($("#pagego").val()); 
		if(v > <?php echo $totalpage; ?> || isNaN(v))
		{
			alert("请输入正确的页码。");
		}else
		{ 
			window.location.href="<?php echo $url; ?>p=" + v;
		}
	});
});
</script>
<div class="menu">
<a href="index.php">返回</a>　　
<a href="class_insert.php">普通录入</a>　　
<a href="data_out.php?name=class">导出数据</a><br/>　　

<form action="class.php" method="get" class="disin">
<input type="hidden" name="act" value="sel">
按入学年查询：起<input type="text" name="syear" size=10 value="<?php echo $syear; ?>" />　止<input type="text" name="eyear" size=10 value="<?php echo $eyear; ?>" />
<input type="submit" value="查询" id="submit" />
</form>
</div>
<form action="" method="post">
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>选择</td>
	<td>班级</td>
	<td>专业</td>
	<td>教室</td>
	<td>容纳</td>
	<td>男生</td>
	<td>女生</td>
	<td>总数</td>
	<td>插班生</td>
	<td>民族生</td>
	<td>班主任</td>
	<td>电话</td>
	<td>班长</td>
	<td>电话</td>
	<td>生源类型</td>
	<td>备注</td>
	<td>操作</td>
</tr>
<?php
if($sql){
if($result){
if(count($result) > 0){
	foreach($result as $v){
		//$majorname = $majorpara[$v->majorid];
		$csex = $yiqi_db->get_results("select count(sid) as c ,sex from student_info where classid='$v->id' and status = '在读' and type != '插班生' group by sex order by sex");
		$c_female = $csex[0]->c;
		$c_male = $csex[1]->c;
		$cnum = $yiqi_db->get_results("select * from student_info where classid='$v->id' and status = '在读' and type != '插班生'");
		$c_total = count($cnum);
		$chaban = $yiqi_db->get_row("select count(sid) as c from student_info where type='插班生' and classid='$v->id'");
		
		$nation = $yiqi_db->get_row("select count(sid) as c from student_info where nationid!='1' and classid='$v->id'");
		
		$qita = $yiqi_db->get_results("select * from student_info where classid='$v->id' and status != '在读'");

		$leixingsql="select distinct(type) as type from student_info where classid='$v->id' and (type='普招生' or type='海外直通车' or type='对口单招' or type='自主招生')";
		$shengyuan_lx=$yiqi_db->get_results($leixingsql);

		$str = '';
		foreach((array)$qita as $v2)
		{
		$str .= $v2->name.$v2->status.'　';
		}
		$rongna = $rongna + $v->capacity;
		$newmale = $newmale + $c_male;
		$newfemale = $newfemale + $c_female;
		$total = $total + $c_total;
		$newchaban = $newchaban + $chaban->c;
		$minzu = $minzu + $nation->c;

		$syleixing="";
		foreach($shengyuan_lx as $val3)
		{
		 $syleixing=$val3->type;
		}
		$statshow = ($v->status == 1)? "(毕业)" : "" ;
		echo "<tr>
      <td><input id=\"slt$v->id\" type=\"checkbox\" name=\"chk[]\" value=\"$v->id\" /></td>
			<td><a href='class_d.php?id=$v->id&syear=$syear&eyear=$eyear'>$v->name</a>$statshow</td>
			<td>$v->majorname</td>
			<td>$v->classroom</td>
			<td>$v->capacity</td>
			<td>$c_male</td>
			<td>$c_female</td>
			<td>$c_total</td>
			<td>$chaban->c</td>
			<td>$nation->c</td>
			<td>$v->deanteacher</td>
			<td>$v->m1</td>
			<td>$v->monitor</td>
			<td>$v->m2</td>
			<td>$syleixing</td>
			<td width='10%'>$str</td>
			<td><a href='class.php?act=delete&cid=$v->id&syear=$syear&eyear=$eyear' onClick='delete_confirm' >删除</a></td>
		</tr>";
	}
}
echo "<tr>
<td></td>
<td>合计</td>
<td></td>
<td></td>
<td>$rongna</td>
<td>$newmale</td>
<td>$newfemale</td>
<td>$total</td>
<td>$newchaban</td>
<td>$minzu</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>";}
		else{echo"<tr><td colspan='20'>暂无记录</td></tr>";}
	}
	else{echo"<tr><td colspan='20'>请输入筛选条件</td></tr>";}
?>
</table>
<div class="clear">&nbsp;</div>
<div class="fl" style="text-indent:26px;"><input id="slt" type="checkbox"/>&nbsp;&nbsp;<select name="stat"><option value="">批量应用</option><option value="v0">取消毕业</option><option value="v1">设为毕业</option></select>&nbsp;<input type="submit" class="subtn" value="提交" onclick="if(!confirm('确认执行相应操作?')) return false;"/></div>
<?php
 if($totalpage > 1)
 {	
	echo '<div class="pager">总计 '.$total1.' 条记录，每页 '.$take.' 条，共 '.$totalpage.' 页。　　　　　到第<input type="text" id="pagego" />页 <input type="button" value=" GO " id="pagego_do" />　'.$pagerhtml.'</div>';
 }
?>
</form>
      	<?php include("footer.php");?>

</body>
</html>
