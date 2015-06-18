<?php
require_once 'include/common.inc.php';
if($_REQUEST['act'] == 'delete')
{
	$sid=$_GET['sid'];
	$mid=$_GET["s_major"];
	$class = $_GET["s_class"];
	$xuenian = $_GET["xuenian"];
	$xueqi = $_GET["xueqi"];
	$scholar=$_GET["scholar"];
	if($sid)
	{
		$sql="delete from scholarship where id='$sid'";
		$result=$yiqi_db->query($sql);
		if($result)
			{
			ShowMsg("删除成功","scholarship.php?s_major=$mid&s_class=$class&xuenian=$xuenian&xueqi=$xueqi&scholar=$scholar");
			}
		else
			{
			ShowMsg("操作失败","back");
			}
	}
}elseif($_REQUEST['act']=='scholar2_delect')
{

	$sid=$_GET['sid'];
	if($sid)
	{
		$sql="delete from scholarship where sid='$sid'";
		
		$result=$yiqi_db->query($sql);
		if($result)
			{
			ShowMsg("删除成功","scholar_result_update.php?");
			}
		else
			{
			ShowMsg("操作失败","back");
			}
	}

}elseif($_REQUEST['act']=='scholar3_delect')
{

	$sid=$_GET['sid'];
	if($sid)
	{
		$sql="delete from scholarship where sid='$sid'";
		
		$result=$yiqi_db->query($sql);
		if($result)
			{
			ShowMsg("删除成功","scholar_honour.php?");
			}
		else
			{
			ShowMsg("操作失败","back");
			}
	}

}elseif($_REQUEST['act'] == 'zaocao_personal_del')
{
	$id = $_GET['id'];
	$sid = $_GET['sid'];
	$name = $_GET['name'];
	$year = $_GET['xuenian'];
	$xueqi = $_GET['xueqi'];
	if($id)
	{
		$sql = "delete from zaocao_personal where id = $id";
		$result=$yiqi_db->query($sql);
		if($result)
			ShowMsg("删除成功","zaocao_personal_record.php?act=list&sid=$sid&sname=$name&xuenian=$year&xueqi=$xueqi");
		else
			ShowMsg("操作失败","back");
	}
}elseif($_REQUEST['act'] == 'zaocao_class_del')
{
	$id = $_GET['id'];
	$mid=$_GET["s_major"];
	$cid = $_GET["s_class"];
	$year = $_GET['xuenian'];
	$xueqi = $_GET['xueqi'];
	$zhouci = $_GET['zhouci'];
	if($id)
	{
		$sql = "delete from zaocao_class where id = $id";
		$result=$yiqi_db->query($sql);
		if($result)
			ShowMsg("删除成功","zaocao_class_score.php?act=zaocao_score&s_major=$mid&s_class=$cid&xuenian=$year&xueqi=$xueqi&zhouci=$zhouci");
		else
			ShowMsg("操作失败","back");
	}
}elseif($_REQUEST['act'] == 'wanzixi_personal_del')
{
	$id = $_GET['id'];
	$sid = $_GET['sid'];
	$name = $_GET['name'];
	$year = $_GET['xuenian'];
	$xueqi = $_GET['xueqi'];
	if($id)
	{
		$sql = "delete from wanzixi_personal where id = $id";
		$result=$yiqi_db->query($sql);
		if($result)
			ShowMsg("删除成功","wanzixi_personal_record.php?act=list&sid=$sid&sname=$name&xuenian=$year&xueqi=$xueqi");
		else
			ShowMsg("操作失败","back");
	}
}elseif($_REQUEST['act'] == 'wanzixi_class_del')
{
	$id = $_GET['id'];
	$mid=$_GET["s_major"];
	$cid = $_GET["s_class"];
	$year = $_GET['xuenian'];
	$xueqi = $_GET['xueqi'];
	$zhouci = $_GET['zhouci'];
	if($id)
	{
		$sql = "delete from wanzixi_class where id = $id";
		$result=$yiqi_db->query($sql);
		if($result)
			ShowMsg("删除成功","wanzixi_class_score.php?act=wanzixi_score&s_major=$mid&s_class=$cid&xuenian=$year&xueqi=$xueqi&zhouci=$zhouci");
		else
			ShowMsg("操作失败","back");
	}
}elseif($_REQUEST['act'] == 'kuangke_personal_del')
{
	$id = $_GET['id'];
	$sid = $_GET['sid'];
	$name = $_GET['name'];
	$year = $_GET['xuenian'];
	$xueqi = $_GET['xueqi'];
	if($id)
	{
		$sql = "delete from stu_absent_record where id = $id";
		$result=$yiqi_db->query($sql);
		if($result)
			ShowMsg("删除成功","kuangke_personal.php?act=list&sid=$sid&sname=$name&xuenian=$year&xueqi=$xueqi");
		else
			ShowMsg("操作失败","back");
	}
}elseif($_REQUEST['act'] == 'dorm_zhian_del')
{
	$id = $_GET['id'];
	$sid = $_GET['sid'];
	$name = $_GET['name'];
	$year = $_GET['xuenian'];
	$xueqi = $_GET['xueqi'];
	if($id)
	{
		$sql = "delete from dormzhian where id = '$id'";
		$result=$yiqi_db->query($sql);
		if($result)
			ShowMsg("删除成功","dorm_zhian.php?act=list&sid=$sid&sname=$name&xuenian=$year&xueqi=$xueqi");
		else
			ShowMsg("操作失败","back");
	}
}elseif($_REQUEST['act'] == 'weisheng_yuanji_del')
{
	$id = $_GET['id'];
	$mid = $_GET["s_major"];
	$cid = $_GET["s_class"];
	$year = $_GET["xuenian"];
	$xueqi = $_GET["xueqi"];
	$zhouci = $_GET["zhouci"];
	if($id)
	{
		$sql = "delete from weisheng_yuanji where id = '$id'";
		$result=$yiqi_db->query($sql);
		if($result)
			ShowMsg("删除成功","weisheng_score.php?act=stat&s_major=$mid&s_class=$cid&xuenian=$year&xueqi=$xueqi&zhouci=$zhouci");
		else
			ShowMsg("操作失败","back");
	}
}elseif($_REQUEST['act'] == 'weisheng_sch_del')
{
	$id = $_GET['id'];
	$mid = $_GET["s_major"];
	$cid = $_GET["s_class"];
	$year = $_GET["xuenian"];
	$xueqi = $_GET["xueqi"];
	$zhouci = $_GET["zhouci"];
	if($id)
	{
		$sql = "delete from weisheng_sch where id = '$id'";
		$result=$yiqi_db->query($sql);
		if($result)
			ShowMsg("删除成功","weisheng_sch_score.php?act=stat&s_major=$mid&s_class=$cid&xuenian=$year&xueqi=$xueqi&zhouci=$zhouci");
		else
			ShowMsg("操作失败","back");
	}
}elseif($_REQUEST['act'] == 'honour_delete')
{
	$sid = $_GET['sid'];
	$year = $_GET['year'];
	$xueqi = $_GET["xueqi"];
	$jibie = $_GET["jibie"];
	if($sid && $year && $xueqi)
	{
		$sql = "delete from stuhonour where sid = '$sid' and year = '$year' and xueqi = '$xueqi'";
		$sql .= ($jibie) ? " and jibie = '$jibie'" : "";
		$result=$yiqi_db->query($sql);
		if($result)
		{	
		ShowMsg("删除成功","honour_select.php?act=stat&s_major=$mid&s_class=$cid&xuenian=$year&xueqi=$xueqi&honour=$jibie");
		}
		else
		{
		ShowMsg("操作失败","back");
		}
	}
}elseif($_REQUEST['act'] == 'bisai_delete')
{
	$id = $_GET['id'];
	$mid = $_GET["s_major"];
	$class = $_GET["s_class"];
	$xueqi = $_GET["xueqi"];
	$xuenian = $_GET["xuenian"];
		$sql = "delete from sbisai_prize where id = $id";
		$result=$yiqi_db->query($sql);
		if($result)
		{	
		ShowMsg("删除成功","bisai_prize.php?act=sel&s_major=$mid&s_class=$class&xuenian=$xuenian&xueqi=$xueqi");
		}
		else
		{
		ShowMsg("操作失败","back");
		}
}elseif($_REQUEST['act'] == 'prize_delete')
{
	$id = $_GET['id'];
	$mid = $_GET["s_major"];
	$class = $_GET["s_class"];
	$xueqi = $_GET["xueqi"];
	$xuenian = $_GET["xuenian"];
		$sql = "delete from social_practice where id = $id";
		$result=$yiqi_db->query($sql);
		if($result)
		{	
		ShowMsg("删除成功","socialprac.php?act=sel&s_major=$mid&s_class=$class&xuenian=$xuenian&xueqi=$xueqi");
		}
		else
		{
		ShowMsg("操作失败","back");
		}
}elseif($_REQUEST['act'] == 'service_del')
{
	$id = $_GET['id'];
	$mid = $_GET["s_major"];
	$class = $_GET["s_class"];
	$xueqi = $_GET["xueqi"];
	$xuenian = $_GET["xuenian"];
		$sql = "delete from vol_service where id = $id";
		$result=$yiqi_db->query($sql);
		if($result)
		{	
		ShowMsg("删除成功","vol_service.php?act=sel&s_major=$mid&s_class=$class&xuenian=$xuenian&xueqi=$xueqi");
		}
		else
		{
		ShowMsg("操作失败","back");
		}
}elseif($_REQUEST['act'] == 'activity_del')
{
	$id = $_GET['id'];
	$mid = $_GET["s_major"];
	$class = $_GET["s_class"];
	$xueqi = $_GET["xueqi"];
	$xuenian = $_GET["xuenian"];
		$sql = "delete from activity_join where id = $id";
		$result=$yiqi_db->query($sql);
		if($result)
		{	
		ShowMsg("删除成功","activity.php?act=stat&s_major=$mid&s_class=$class&xuenian=$xuenian&xueqi=$xueqi");
		}
		else
		{
		ShowMsg("操作失败","back");
		}
}elseif($_REQUEST['act'] == 'chufen_del')
{
	$id = $_GET['id'];
	$mid = $_GET["s_major"];
	$cid = $_GET["s_class"];
	$nianji = $_GET["nianji"];
	$stuname = $_GET["stuname"];
	$stuid = $_GET["stuid"];
	$jibie = $_GET["jibie"];
		$sql = "delete from stu_chufen where id = $id";
		$result=$yiqi_db->query($sql);
		if($result)
		{	
		ShowMsg("删除成功","stu_chufen.php?act=chufen&s_major=$mid&s_class=$cid&nianji=$nianji&stuname=$stuname&stuid=$stuid&jibie=$jibie");
		}
		else
		{
		ShowMsg("操作失败","back");
		}
}elseif($_REQUEST['act'] == 'sushe_star_del')
{
	$id = $_GET['id'];
	$mid = $_GET["s_major"];
	$cid = $_GET["s_class"];
	$year = $_GET["xuenian"];
	$xueqi = $_GET["xueqi"];
	$month = $_GET["month"];
		$sql = "delete from sushe_star where id = $id";
		$result=$yiqi_db->query($sql);
		if($result)
		{	
		ShowMsg("删除成功","back");
		}
		else
		{
		ShowMsg("操作失败","back");
		}
}else
{
	ShowMsg("操作失败","back");
}
?>
