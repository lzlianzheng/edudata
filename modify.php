<?php
require_once 'include/common.inc.php';
if($_REQUEST['act'] == 'zaocao_personal_save')
{
	$id = $_REQUEST['nid'];
	$year = $_REQUEST['xuenian'];
	$xueqi = $_REQUEST['xueqi'];
	$zhouci = $_REQUEST['zhouci'];
	$kuangcaodate = $_REQUEST['kuangcaodate'];
	$chidaodate = $_REQUEST['chidaodate'];
	$burenzhendate = $_REQUEST['burenzhendate'];
	$recorder = $_REQUEST['recorder'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update zaocao_personal set year='$year',xueqi='$xueqi',zhouci='$zhouci',kuangcaodate='$kuangcaodate',chidaodate='$chidaodate',recorder='$recorder',burenzhendate='$burenzhendate',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
		ShowMsg("修改成功","back");
	else
		ShowMsg("修改失败","back");
	
}
elseif($_REQUEST['act'] == 'zaocao_class_save')
{
	$id = $_REQUEST['id'];
	$classname = $_REQUEST['classname'];
	$year = $_REQUEST['xuenian'];
	$zhouci = $_REQUEST['zhouci'];
	$xueqi = $_REQUEST['xueqi'];
	$score = $_REQUEST['score'];
	$recorder = $_REQUEST['recorder'];
	$datenow = date("Y-m-d H:i:s");
	$sql ="update zaocao_class set class='$classname',year='$year',xueqi='$xueqi',zhouci='$zhouci',score='$score',recorder='$recorder' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
		ShowMsg("修改成功","zaocao_score_m.php?act=sel&id=$id");
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act'] == 'wanzixi_personal_save')
{
	$id = $_REQUEST['nid'];
	$name = $_REQUEST['name'];
	$classname = $_REQUEST['classname'];
	$year = $_REQUEST['xuenian'];
	$xueqi = $_REQUEST['xueqi'];
	$zhouci = $_REQUEST['zhouci'];
	$kuangkedate = $_REQUEST['kuangkedate'];
	$chidaodate = $_REQUEST['chidaodate'];
	$zaotuidate = $_REQUEST['zaotuidate'];
	$recorder = $_REQUEST['recorder'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update wanzixi_personal set class='$classname',name='$name',year='$year',xueqi='$xueqi',zhouci='$zhouci',kuangkedate='$kuangkedate',chidaodate='$chidaodate',recorder='$recorder',zaotuidate='$zaotuidate',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
		ShowMsg("修改成功","back");
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act'] == 'wanzixi_class_save')
{
	$id = $_REQUEST['id'];
	$classname = $_REQUEST['classname'];
	$year = $_REQUEST['xuenian'];
	$zhouci = $_REQUEST['zhouci'];
	$xueqi = $_REQUEST['xueqi'];
	$score = $_REQUEST['score'];
	$recorder = $_REQUEST['recorder'];
	$datenow = date("Y-m-d H:i:s");
	$sql ="update wanzixi_class set year='$year',xueqi='$xueqi',zhouci='$zhouci',score='$score',recorder='$recorder' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
		ShowMsg("修改成功","back");
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act'] == 'kuangke_personal_save')
{
	$id = $_REQUEST['id'];
	$name = $_REQUEST['name'];
	$classname = $_REQUEST['classname'];
	$year = $_REQUEST['xuenian'];
	$xueqi = $_REQUEST['xueqi'];
	$zhouci = $_REQUEST['zhouci'];
	$kuangkekeshi = $_REQUEST['kuangkekeshi'];
	$coursename = $_REQUEST['coursename'];
	$chidaokeshi = $_REQUEST['chidaokeshi'];
	$chidaocourse = $_REQUEST['chidaocourse'];
	$chidaodate = $_REQUEST['chidaodate'];
	$absentriqi = $_REQUEST['absentriqi'];
	$zaotuikeshi = $_REQUEST['zaotuikeshi'];
	$zaotuicourse = $_REQUEST['zaotuicourse'];
	$zaotuidate = $_REQUEST['zaotuidate'];
	$recorder = $_REQUEST['recorder'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update stu_absent_record set classname='$classname',name='$name',year='$year',xueqi='$xueqi',zhouci='$zhouci',keshi='$kuangkekeshi',coursename='$coursename',chidaokeshi='$chidaokeshi',chidaocourse='$chidaocourse',chidaodate='$chidaodate',zaotuikeshi='$zaotuikeshi',zaotuicourse = '$zaotuicourse',zaotuidate ='$zaotuidate',absentriqi='$absentriqi',recorder='$recorder',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
		ShowMsg("修改成功","kuangke_personal_modify.php?act=sel&id=$id");
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act'] == 'dorm_zhian')
{
	$id = $_REQUEST['id'];
	$name = $_REQUEST['name'];
	$classname = $_REQUEST['classname'];
	$year = $_REQUEST['xuenian'];
	$xueqi = $_REQUEST['xueqi'];
	$zhouci = $_REQUEST['zhouci'];
	$time = $_REQUEST['time'];
	$weiji = $_REQUEST['weiji'];
	$jibie = $_REQUEST['jibie'];
	$recorder = $_REQUEST['recorder'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update dormzhian set class='$classname',name='$name',year='$year',xueqi='$xueqi',zhouci='$zhouci',time='$time',weiji='$weiji',jibie='$jibie',recorder='$recorder',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
		ShowMsg("修改成功","back");
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act'] == 'weisheng_yuanji')
{
	$id = $_REQUEST['id'];
	$classname = $_REQUEST['classname'];
	$year = $_REQUEST['xuenian'];
	$xueqi = $_REQUEST['xueqi'];
	$zhouci = $_REQUEST['zhouci'];
	$checkdate = $_REQUEST['checkdate'];
	$score = $_REQUEST['score'];
	$dormlou = $_REQUEST['dormlou'];
	$dormnum = $_REQUEST['dormnum'];
	$recorder = $_REQUEST['recorder'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update weisheng_yuanji set class='$classname',year='$year',xueqi='$xueqi',zhouci='$zhouci',dormlou='$dormlou',dormnum ='$dormnum',checkdate='$checkdate',score='$score',recorder='$recorder',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
		ShowMsg("修改成功","back");
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act'] == 'weisheng_sch')
{
	$id = $_REQUEST['id'];
	$classname = $_REQUEST['classname'];
	$year = $_REQUEST['xuenian'];
	$xueqi = $_REQUEST['xueqi'];
	$zhouci = $_REQUEST['zhouci'];
	$checkdate = $_REQUEST['checkdate'];
	$score = $_REQUEST['score'];
	$dormlou = $_REQUEST['dormlou'];
	$dormnum = $_REQUEST['dormnum'];
	$recorder = $_REQUEST['recorder'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update weisheng_sch set class='$classname',year='$year',xueqi='$xueqi',zhouci='$zhouci',dormlou='$dormlou',dormnum ='$dormnum',checkdate='$checkdate',score='$score',recorder='$recorder',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
		ShowMsg("修改成功","back");
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act'] == 'bisai')
{
	$id = $_REQUEST['id'];
	$year = $_REQUEST['xuenian'];
	$xueqi = $_REQUEST['xueqi'];
	$prizedate = $_REQUEST['prizedate'];
	$level = $_REQUEST['level'];
	$prizename = $_REQUEST['prizename'];
	$prizegrade = $_REQUEST['prizegrade'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update sbisai_prize set prizeyear='$year',prizexueqi='$xueqi',prizedate ='$prizedate',level='$level',prizename='$prizename',prizegrade='$prizegrade',addtime='$datenow' where id='$id'";
	print_r($sql);
	$result = $yiqi_db->query($sql);
	if($result)
		ShowMsg("修改成功","back");
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act']=='sch2')
{

	$id = $_REQUEST['id'];
	$name = $_REQUEST['name'];
	$sid = $_REQUEST['sid'];
	$year = $_REQUEST['year'];
	$xueqi = $_REQUEST['xueqi'];
	$level = $_REQUEST['level'];
	$beizhu=$_REQUEST['beizhu'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update scholarship set 
	year='$year',
	xueqi=$xueqi,
	sid='$sid',
	name='$name',
	scholarship='$level',
	beizhu='$beizhu',
	addtime='$datenow' where id='$id'";
	//print_r($sql);
	$result = $yiqi_db->query($sql);
	//print_r($result);
	if($result)
		ShowMsg("修改成功","scholar_result_update.php?&id=$id");
	else
		ShowMsg("修改失败","back");

}
elseif($_REQUEST['act']=='sch3')
{

	$id = $_REQUEST['id'];
	$name = $_REQUEST['name'];
	$sid = $_REQUEST['sid'];
	$year = $_REQUEST['year'];
	$xueqi = $_REQUEST['xueqi'];
	$honourname = $_REQUEST['honourname'];
	$jibie=$_REQUEST['jibie'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update stuhonour set 
	year='$year',
	xueqi=$xueqi,
	sid='$sid',
	name='$name',
	honourname='$honourname',
	jibie='$jibie',
	addtime='$datenow' where id='$id'";
	
	$result = $yiqi_db->query($sql);
	//print_r($result);
	if($result)
		ShowMsg("修改成功","scholar_honour.php?&id=$id");
	else
		ShowMsg("修改失败","back");

}
elseif($_REQUEST['act'] == 'social_practice')
{
	$id=$_REQUEST['nid'];
	$jibie=$_REQUEST['jibie'];
	$per_jibie=$_REQUEST['per_jibie'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$datenow = date("Y-m-d H:i:s");
	$datenow = date("Y-m-d H:i:s");
	$sql = "update social_practice set jibie='$jibie',per_jibie='$per_jibie',xuenian='$xuenian',xueqi='$xueqi',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
		//ShowMsg("修改成功","socialprac.php?act=sel&s_class=$classname&xuenian=$year&xueqi=$xueqi");
		ShowMsg("修改成功","back");
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act'] == 'service')
{
	$id = $_REQUEST['id'];
	$classname = $_REQUEST['s_class'];
	$name = $_REQUEST['name'];
	$sid = $_REQUEST['sid'];
	$year = $_REQUEST['year'];
	$xueqi = $_REQUEST['xueqi'];
	$grade = $_REQUEST['grade'];
	$content = $_REQUEST['content'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update vol_service set class='$classname',name='$name',sid='$sid',year='$year',xueqi='$xueqi',content ='$content',time='$time',grade='$grade',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
		//ShowMsg("修改成功","vol_service.php?act=sel&s_class=$classname&xuenian=$year&xueqi=$xueqi");
		ShowMsg("修改成功","service_d.php?id=$id");
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act'] == 'activity')
{
	$id = $_REQUEST['nid'];
	$act_name = $_REQUEST['act_name'];
	$xuenian = $_REQUEST['xuenian'];
	$xueqi = $_REQUEST['xueqi'];
	$jibie = $_REQUEST['jibie'];
	$content = $_REQUEST['content'];
	$act_date = $_REQUEST['act_date'];
	$datenow = date("Y-m-d H:i:s");
	
	if($content && $act_name && $act_date && $jibie)
	{
		$sql = "update activity_join set xuenian='$xuenian',xueqi='$xueqi',jibie='$jibie',act_name='$act_name',content='$content',act_date ='$act_date' where id='$id'";
		$result = $yiqi_db->query($sql);
		if($result)
			ShowMsg("修改成功","back");
		//echo "success";
		else
			ShowMsg("修改失败","back");
		//echo "fail";
	}
	else
		ShowMsg("请输入完整的信息！","back");
}
elseif($_REQUEST['act'] == 'chufen')
{
	$id = $_REQUEST['id'];
	$classname = $_REQUEST['classname'];
	$name = $_REQUEST['name'];
	$sid = $_REQUEST['sid'];
	$type = $_REQUEST['type'];
	$reason = $_REQUEST['reason'];
	$wenjianhao = $_REQUEST['wenjianhao'];
	$chufendata = $_REQUEST['chufendata'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update stu_chufen set classname='$classname',name='$name',sid='$sid',type='$type',reason='$reason',wenjianhao ='$wenjianhao',chufendata='$chufendata',edittime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
		ShowMsg("修改成功","chufen_d.php?id=$id");
		//echo "success";
	else
		ShowMsg("修改失败","back");
		//echo "fail";
}
elseif($_REQUEST['act'] == 'sushe_star')
{
	$id = $_REQUEST['id'];
	$s_class = $_REQUEST['s_class'];
	$year = $_REQUEST['xuenian'];
	$xueqi = $_REQUEST['xueqi'];
	$month = $_REQUEST['month'];
	$score = $_REQUEST['score'];
	$dormlou = $_REQUEST['dormlou'];
	$dormnum = $_REQUEST['dormnum'];
	$recorder = $_REQUEST['recorder'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update sushe_star set class='$s_class',year='$year',xueqi='$xueqi',month='$month',dormlou='$dormlou',dormnum ='$dormnum',score='$score',recorder='$recorder',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
		ShowMsg("修改成功","back");
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act'] == 'stu_leader')
{
	$year=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$id=$_REQUEST['nid'];
	$org_class=$_REQUEST['org_class'];
	$org_jibie=$_REQUEST['org_jibie'];
	$zhiwu=$_REQUEST['org_zhiwu'];
	$qq=$_REQUEST['qq'];
	$emp_time=$_REQUEST['emp_time'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	//ShowMsg("$id","back");
	$sql = "update stu_leader set org_class='$org_class',org_grade='$org_jibie',zhiwu='$zhiwu',qq='$qq',emp_time='$emp_time',year='$year',xueqi='$xueqi',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($year && $xueqi)
	{
		if($org_class && $org_jibie && $zhiwu)
		{
			if($result)
				ShowMsg("修改成功","back");
			else
				ShowMsg("修改失败","back");
		}
		else
			ShowMsg("请输入完整的组织、级别和职务！","back");
	}
	else
		ShowMsg("请输入干部任职所属学年/学期","back");
}
elseif($_REQUEST['act'] == 'clg_good')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$yougan=$_REQUEST['yougan'];
	$sanhao=$_REQUEST['sanhao'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if($yougan != "0" || $sanhao != "0")
	{
		$sql = "update clg_good set sid='$sid',yougan='$yougan',sanhao='$sanhao',year='$xuenian',xueqi='$xueqi',addtime='$datenow' where sid='$sid'";
		$result = $yiqi_db->query($sql);
		if($result)
			ShowMsg("修改成功","back");
		else
			ShowMsg("修改失败","back");
	}
	else 
		ShowMsg("请任选一项优秀称号！","back");
}
elseif($_REQUEST['act'] == 'cp_cla_leader')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$cpdengji=$_REQUEST['cpdengji'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	//ShowMsg("$id","back");
	$sql = "update cp_cla_leader set sid='$sid',cpdengji='$cpdengji',year='$xuenian',xueqi='$xueqi',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
	{
		if($cpdengji)
		
			ShowMsg("修改成功","back");
		else
			ShowMsg("修改失败","back");
	}
	else
		ShowMsg("请输入测评等级！","back");
}
elseif($_REQUEST['act'] == 'hour_su_leader')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$jibie=$_REQUEST['jibie'];
	$mingcheng=$_REQUEST['mingcheng'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update hour_su_leader set sid='$sid',jibie='$jibie',mingcheng='$mingcheng',year='$xuenian',xueqi='$xueqi',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($jibie && $mingcheng)
	{
		if($result)
			ShowMsg("修改成功","back");
		else
			ShowMsg("修改失败","back");
		
	}
	else
		ShowMsg("请输入完整的级别和名称！","back");
}
elseif($_REQUEST['act'] == 'cp_su_ganshi')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$jibie=$_REQUEST['jibie'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update cp_su_ganshi set sid='$sid',jibie='$jibie',year='$xuenian',xueqi='$xueqi',addtime='$datenow' where id='$id'";
		$result = $yiqi_db->query($sql);
	if($result)
	{
		if($jibie)
		
			ShowMsg("修改成功","back");
		else
			ShowMsg("修改失败","back");
	}
	else
		ShowMsg("请输入相应的级别！","back");
}
elseif($_REQUEST['act']=='org_class_update')
{

	$class= $_REQUEST['class'];
	$sql = "INSERT INTO `org_style`( `class`) VALUES ('$class')";
	$result = $yiqi_db->query($sql);
	if($class)
	{
		if($result)
			ShowMsg("添加成功","back");
		else
			ShowMsg("添加失败","back");
	}
	else 
		ShowMsg("请输入组织名称","back");

}
elseif($_REQUEST['act']=='org_zhiwu_update')
{

	$cid = $_REQUEST['classid'];
	$name=$_REQUEST['zhiwu'];
	$sql = "INSERT INTO `org_style_d`(`name`,`cid`) VALUES ('$name','$cid')";
	$result = $yiqi_db->query($sql);
	if($name)
	{
		if($result)
			ShowMsg("添加成功","back");
		else
			ShowMsg("添加失败","back");
	}
	else
		ShowMsg("请输入职务名称！","back");
}
elseif($_REQUEST['act']=='org_modify_class')
{

	$id = $_REQUEST['class_id'];
	$mingcheng=$_REQUEST['mingcheng'];
	$sql = "update org_style set class='$mingcheng' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($mingcheng)
	{
		if($result)
			ShowMsg("修改成功","org_update_modify.php?act=update_class&org_name=$mingcheng");
		else
			ShowMsg("修改失败","back");
	}
	else
		ShowMsg("请输入组织名称","back");
}
elseif($_REQUEST['act']=='org_modify_zhiwu')
{

	$id = $_REQUEST['zhiwu_id'];
	$mingcheng=$_REQUEST['mingcheng'];
	$sql = "update org_style_d set name='$mingcheng' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($mingcheng)
	{
		if($result)
			ShowMsg("修改成功","org_update_modify.php?act=update_zhiwu&org_name=$mingcheng");
		else
			ShowMsg("修改失败","back");
	}
	else
		ShowMsg("请输入职务名称！","back");
}
elseif($_REQUEST['act'] == 'hour_tuan')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$jibie=$_REQUEST['jibie'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$tuanyuan=$_REQUEST['tuanyuan'];
	$tuangan=$_REQUEST['tuangan'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");

	if($jibie)
	{
		if($tuanyuan || $tuangan)
		{
			$sql = "update hour_tuan set sid='$sid',jibie='$jibie',tuanyuan='$tuanyuan',tuangan='$tuangan',xuenian='$xuenian',xueqi='$xueqi',addtime='$datenow' where sid='$sid'";
			$result = $yiqi_db->query($sql);
			if($result)
				ShowMsg("修改成功","back");
			else
				ShowMsg("修改失败","back");
		}
		else
			ShowMsg("请勾选任意一项优秀称号！","back");
	}
	else
		ShowMsg("请选择相应的级别！","back");
}
elseif($_REQUEST['act'] == 'hour_vol')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$jibie=$_REQUEST['jibie'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");

	if($jibie)
	{
		$sql = "update hour_vol set sid='$sid',jibie='$jibie',xuenian='$xuenian',xueqi='$xueqi',addtime='$datenow' where id='$id'";
		$result = $yiqi_db->query($sql);
		if($result)
			ShowMsg("修改成功","back");
		else
			ShowMsg("修改失败","back");
	}
	else
		ShowMsg("请选择相应的级别！","back");
}
elseif($_REQUEST['act'] == 'hour_grouper')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$jibie=$_REQUEST['jibie'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$ganshi=$_REQUEST['ganshi'];
	$ganbu=$_REQUEST['ganbu'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");

	if($jibie)
	{
		if($ganshi || $ganbu)
		{
			$sql = "update hour_grouper set sid='$sid',jibie='$jibie',ganshi='$ganshi',ganbu='$ganbu',xuenian='$xuenian',xueqi='$xueqi',addtime='$datenow' where sid='$sid'";
			$result = $yiqi_db->query($sql);
			if($result)
				ShowMsg("修改成功","back");
			else
				ShowMsg("修改失败","back");
		}
		else
			ShowMsg("请勾选任意一项优秀称号！","back");
	}
	else
		ShowMsg("请选择相应的级别！","back");
}
elseif($_REQUEST['act'] == 'pub_paper')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$artname=$_REQUEST['artname'];
	$pubtime=$_REQUEST['pubtime'];
	$pubname=$_REQUEST['pubname'];
	$pubjibie=$_REQUEST['pubjibie'];
	$money=$_REQUEST['money'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if($artname && $pubtime && $pubname && $pubjibie && $money)
	{
		$sql = "update pub_paper set sid='$sid',artname='$artname',pubtime='$pubtime',pubname='$pubname',pubjibie='$pubjibie',money='$money',xuenian='$xuenian',xueqi='$xueqi',addtime='$datenow' where id='$id'";
		$result = $yiqi_db->query($sql);
		if($result)
			ShowMsg("修改成功","back");
		else
			ShowMsg("修改失败","back");
	}
	else
			ShowMsg("请输入完整的信息！","back");
}
elseif($_REQUEST['act'] == 'tech_invent')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$type=$_REQUEST['type'];
	$content=$_REQUEST['content'];
	$time=$_REQUEST['time'];
	$danwei=$_REQUEST['danwei'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	
	if($type && $content && $time && $danwei)
	{
		$sql = "update tech_invent set sid='$sid',type='$type',content='$content',time='$time',danwei='$danwei',xuenian='$xuenian',xueqi='$xueqi',addtime='$datenow' where id='$id'";
		$result = $yiqi_db->query($sql);
		if($result)
			ShowMsg("修改成功","back");
		else
			ShowMsg("修改失败","back");
	}
	else
			ShowMsg("请输入完整的信息！","back");
}
elseif($_REQUEST['act'] == 'english')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$thirda=$_REQUEST['thirda'];
	$thirdb=$_REQUEST['thirdb'];
	$cet4=$_REQUEST['cet4'];
	$cet6=$_REQUEST['cet6'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	
	if(!$thirda && !$thirdb && !$cet4 && !$cet6)
	{
		ShowMsg("请输入任意一项英语等级考试成绩！","back");
	}
	elseif($thirda || $thirdb || $cet4 || $cet6){
		$sql = "update english set sid='$sid',thirda='$thirda',thirdb='$thirdb',cet4='$cet4',cet6='$cet6',addtime='$datenow' where id='$id'";
		$result = $yiqi_db->query($sql);
		ShowMsg("修改成功","back");}
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act'] == 'computer')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$first=$_REQUEST['first'];
	$second=$_REQUEST['second'];
	$datenow = date("Y-m-d H:i:s");
	if(!$first && !$second)
	{
		ShowMsg("请输入任意一项计算机等级考试成绩！","back");
	}
	elseif($first || $second){
			$sql = "update computer set sid='$sid',first='$first',second='$second',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	ShowMsg("修改成功","back");}
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act'] == 'qua')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$mingcheng=$_REQUEST['mingcheng'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update qualification set sid='$sid',mingcheng='$mingcheng',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
		ShowMsg("修改成功","back");
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act'] == 'order')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$mingcheng=$_REQUEST['mingcheng'];
	$datenow = date("Y-m-d H:i:s");
	$sql = "update order_info set sid='$sid',mingcheng='$mingcheng',xuenian='$xuenian',xueqi='$xueqi',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
		ShowMsg("修改成功","back");
	else
		ShowMsg("修改失败","back");
}
elseif($_REQUEST['act'] == 'serve_vol')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$jibie=$_REQUEST['jibie'];
	$content=$_REQUEST['content'];
	$serdate=$_REQUEST['serdate'];
	$sertime=$_REQUEST['sertime'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$datenow = date("Y-m-d H:i:s");
	if($jibie && $content && $serdate && $sertime)
	{
		$sql = "update serve_vol set sid='$sid',jibie='$jibie',content='$content',serdate='$serdate',sertime='$sertime',xuenian='$xuenian',xueqi='$xueqi',addtime='$datenow' where id='$id'";
		$result = $yiqi_db->query($sql);
		if($result)
			ShowMsg("修改成功","back");
		else
			ShowMsg("修改失败","back");
	}
	else
		ShowMsg("请输入完整的信息！","back");
}
elseif($_REQUEST['act'] == 'scholarship')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$scholarship=$_REQUEST['scholarship'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	//ShowMsg("$id","back");
	$sql = "update scholarship set sid='$sid',scholarship='$scholarship',year='$xuenian',xueqi='$xueqi',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
	{
		if($scholarship)
		
			ShowMsg("修改成功","back");
		else
			ShowMsg("修改失败","back");
	}
	else
		ShowMsg("请输入测评等级！","back");
}
elseif($_REQUEST['act'] == 'schip_single')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$jibie=$_REQUEST['jibie'];
	$cause=$_REQUEST['cause'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	//ShowMsg("$id","back");
	$sql = "update schip_single set sid='$sid',cause='$cause',jibie='$jibie',xuenian='$xuenian',xueqi='$xueqi',addtime='$datenow' where id='$id'";
	$result = $yiqi_db->query($sql);
	if($result)
	{
		if($jibie)
		
			ShowMsg("修改成功","back");
		else
			ShowMsg("修改失败","back");
	}
	else
		ShowMsg("请输入测评等级！","back");
}
elseif($_REQUEST['act'] == 'sch_honour')
{
	$id = $_REQUEST['nid'];
	$sid=$_REQUEST['stu_id'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$yougan=$_REQUEST['yougan'];
	$sanhao=$_REQUEST['sanhao'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if($yougan != "0" || $sanhao != "0")
	{
		$sql = "update honour set sid='$sid',yougan='$yougan',sanhao='$sanhao',xuenian='$xuenian',xueqi='$xueqi',addtime='$datenow' where sid='$sid'";
		$result = $yiqi_db->query($sql);
		if($result)
			ShowMsg("修改成功","back");
		else
			ShowMsg("修改失败","back");
	}
	else 
		ShowMsg("请任选一项优秀称号！","back");
}
elseif($_REQUEST['act'] == 'buwenming')
{
	$sid=$_REQUEST['sid'];
	$xuenian=$_REQUEST['xuenian'];
	$xueqi=$_REQUEST['xueqi'];
	$content=$_REQUEST['content'];
	$zhouci=$_REQUEST['zhouci'];
	$recorder=$_REQUEST['recorder'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if($recorder)
	{
		$sql = "update buwenming set recorder='$recorder',zhouci='$zhouci',content='$content',time='$time',xuenian='$xuenian',xueqi='$xueqi',addtime='$datenow' where sid='$sid'";
		$result = $yiqi_db->query($sql);
		if($result)
			ShowMsg("修改成功","back");
		else
			ShowMsg("修改失败","back");
	}
	else 
		ShowMsg("请输入记录人信息","back");
}
?>
