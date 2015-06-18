<?php
require_once 'include/common.inc.php';

	$sql="select a.id ,a.class,b.name from org_style a  join org_style_d b on a.id=b.cid where 1";
	$result=$yiqi_db->get_results($sql);
	$data = array();
	foreach($result as $v)
	{
		$record=array($v->name,$v->class,$v->id);
		$data[$v->class][$v->name] = $record;
	}

	if($_REQUEST['act']=='delete')
	{
		$orgname = $_GET["orgname"];
		$sql="delete from org_style_d where name='$orgname'";
		$result=$yiqi_db->query($sql);
		//echo "<script type=text/javascript>alert('删除成功');window.history.go(-1);</script>";exit;
		if($result==1)
			ShowMsg("删除成功","back");
		else
			ShowMsg("操作失败","back");
	}
		if($_REQUEST['act']=='class_delete')
	{
		$orgname = $_GET["orgname"];
		$sql="select * from org_style where class = '$orgname'";
		$result=$yiqi_db->get_row($sql);
		$cid = $result->id;
		$sql1 = "delete from org_style_d where cid =$cid";
		$result1=$yiqi_db->query($sql1);
		$sql2 = "delete from org_style where class = '$orgname'";
		$result2=$yiqi_db->query($sql2);
		if($result1&&$result2)
			ShowMsg("删除成功","back");
		else
			ShowMsg("操作失败","back");
	}
$title="组织类别修改";
include("header.php");
		echo "<div class='nav'>
        <span class='fr'>
		<a href='stu_leader.php'>干部任职查询</a>
		<a href='org_update.php'>组织结构修改</a>
        </span>
		</div>";
?>
<div class="tc"><a href="stu_leader.php?">返回</a><br/></div>
<table cellspacing="0" cellpadding="0" class="t_list tc list4">
<tr>
	
	<td>组织类别	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="org_update_cla_d.php">新增</a>
	<td>职务		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="org_update_zw_d.php">新增</a>
</tr>

<?php
if(count($data)>0){
	foreach($data as $k=>$v){
		$cnow = count($v);
		
		echo "<tr><td rowspan='$cnow'>".$k."&nbsp;&nbsp;&nbsp;&nbsp;<a href='org_update_modify.php?act=update_class&org_name=$k'>修改</a>	<a href='org_update.php?act=class_delete&orgname=$k'>删除</a></td>";
		if($cnow > 0){
			foreach($v as $k1=>$v1){
			//print_r($v);
			
					echo "<td>$k1&nbsp;&nbsp;&nbsp;&nbsp;<a href='org_update_modify.php?act=update_zhiwu&org_name=$k1'>修改</a>		
						<a href='org_update.php?act=delete&orgname=$k1'>删除</a></td>
					</tr>";
			}
		}
	}
}
?>
</table>
      	<?php include("footer.php");?>
</body>
</html>

