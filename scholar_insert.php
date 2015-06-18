<?php
require_once 'include/common.inc.php';
$now = date("Y-m-d H:i:s");
if($_REQUEST['act']=='save')
{
	$year=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$sid=$_REQUEST['sid'];
	$name=$_REQUEST['name'];
	$grade=$_REQUEST['level'];
	$beizhu=$_REQUEST['beizhu'];
	$sch=$_REQUEST['sch'];
	$yuanji=$_REQUEST['yuanji'];
	$yjscholar=$_REQUEST['yjscholar'];
	if($year && $xueqi)
	{
		$del="delete from scholarship where year='$year' and xueqi=$xueqi and sid=$sid";
		$yiqi_db->query($del);
		if($grade){
			$sql="insert into scholarship (`id`,`xueyuan`,`year`,`xueqi`,`class`,`sid`,`name`,`scholarship`,`beizhu`,`addtime`) values (NULL,'','$year','$xueqi','','$sid','$name','$grade','$beizhu','$now')";
			$a=$yiqi_db->query($sql);
			if($a)
				$str.="奖学金写入成功、";
			else
				$str.="奖学金写入失败、";
		}
	}
	if( $year && $xueqi)
	{
		$del2="delete from stuhonour where year='$year' and xueqi=$xueqi and sid=$sid";
		$yiqi_db->query($del2);
		if(count($sch)>0)
		{
			foreach($sch as $v)
			{
				$sql="insert into stuhonour (`id`,`year`,`xueqi`,`class`,`sid`,`name`,`honourname`,`jibie`,`addtime`) values (NULL,'$year','$xueqi','','$sid','$name','$v','校级','$now')";
				$b=$yiqi_db->query($sql);
				if($b)
					$str.="校级荣誉写入成功、";
				else
					$str.="校级荣誉写入失败、";
			}
		}
		if(count($yuanji)>0)
		{
			foreach($yuanji as $v)
			{
				$sql="insert into stuhonour (`id`,`year`,`xueqi`,`class`,`sid`,`name`,`honourname`,`jibie`,`addtime`) values (NULL,'$year','$xueqi','','$sid','$name','$v','院级','$now')";
				$c=$yiqi_db->query($sql);
				if($c)
					$str.="院级荣誉写入成功、";
				else
					$str.="院级荣誉写入失败、";
			}
		}
		if(count($yjscholar)>0)
		{
			foreach($yjscholar as $v)
			{
				$sql="insert into stuhonour (`id`,`year`,`xueqi`,`class`,`sid`,`name`,`honourname`,`jibie`,`addtime`) values (NULL,'$year','$xueqi','','$sid','$name','$v','院级','$now')";
				$d=$yiqi_db->query($sql);
				if($d)
					$str.="院奖学金写入成功";
				else
					$str.="院奖学金写入失败";
			}
		}
}
	if($str)
		exit($str);
	else
		exit("录入失败，请确认参数正确");
}elseif($_REQUEST['act']=='act_join')
{
	$sid=$_REQUEST['sid'];
	$jibie=$_REQUEST['jibie'];
	$content = $_REQUEST['content'];
	$act_name = $_REQUEST['act_name'];
	$act_date = $_REQUEST['act_date'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if($content && $act_name && $act_date && $jibie)
	{
		$sql="insert into activity_join (`sid`,`jibie`,`xuenian`,`xueqi`,`content`,`act_name`,`act_date`,`addtime`) values ('$sid','$jibie','$xuenian','$xueqi','$content','$act_name','$act_date','$datenow')";
		$a=$yiqi_db->query($sql);
		if($a)
		{
			$str .= "写入成功！";
		}	
	}
	else
		exit("请输入完整的信息！");
	if($str)
		exit($str);
	else 
		exit("写入失败！");
	 

}elseif($_REQUEST['act']=='zaocao_personal')
{
	$year=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$sid=$_REQUEST['sid'];
	$name=$_REQUEST['name'];
	$classname = $_REQUEST['classname'];
	$zhouci = $_REQUEST['zhouci'];
	$kuangcaoriqi = $_REQUEST['kuangcaoriqi'];
	$chidaoriqi = $_REQUEST['chidaoriqi'];
	$burenzhenriqi = $_REQUEST['burenzhenriqi'];
	$recorder = $_REQUEST['recorder'];
	if($year && $xueqi)
	{
		if($zhouci && $recorder)
		{	
			$sql= "insert into zaocao_personal (`id`,`classname`,`sid`,`name`,`year`,`xueqi`,`zhouci`,`kuangcaodate`,`chidaodate`,`burenzhendate`,`recorder`,`addtime`) values (NULL,'$classname','$sid','$name','$year','$xueqi','$zhouci','$kuangcaoriqi','$chidaoriqi','$burenzhenriqi','$recorder','$now')";
			$a=$yiqi_db->query($sql);
			if($a)
			{
			$str .= "写入成功！";
			}
		}
		else
		{
			exit("请输入周次和记录人信息！");
		}
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}elseif($_REQUEST['act'] == 'zaocao_class')
{
	$year = $_REQUEST['year'];
	$xueqi = $_REQUEST['xueqi'];
	$classname = $_REQUEST['classname'];
	$zhouci = $_REQUEST['zhouci'];
	$score = $_REQUEST['score'];
	$recorder = $_REQUEST['recorder'];
	$sql = "insert into zaocao_class (`id`,`class`,`year`,`xueqi`,`zhouci`,`score`,`recorder`,`addtime`) values (NULL,'$classname','$year','$xueqi','$zhouci','$score','$recorder','$now')";
	$a=$yiqi_db->query($sql);
	if($a)
	{
		$str .= "写入成功！";
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}elseif($_REQUEST['act']=='wanzixi_personal')
{
	$year=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$sid=$_REQUEST['sid'];
	$name=$_REQUEST['name'];
	$classname = $_REQUEST['classname'];
	$zhouci = $_REQUEST['zhouci'];
	$kuangkedate = $_REQUEST['kuangkeriqi'];
	$chidaodate = $_REQUEST['chidaoriqi'];
	$zaotuidate = $_REQUEST['zaotuiriqi'];
	$recorder = $_REQUEST['recorder'];
	if($zhouci && $recorder)
	{
		$sql= "insert into wanzixi_personal (`id`,`class`,`sid`,`name`,`year`,`xueqi`,`zhouci`,`kuangkedate`,`chidaodate`,`zaotuidate`,`recorder`,`addtime`) values (NULL,'$classname','$sid','$name','$year','$xueqi','$zhouci','$kuangkedate','$chidaodate','$zaotuidate','$recorder','$now')";
		$a=$yiqi_db->query($sql);
		if($a)
		{
			exit("写入成功！");
		}
	}
	if($str)
		exit($str);
	else 
		exit("请输入周次和记录人信息！");
}elseif($_REQUEST['act'] == 'wanzixi_class')
{
	$year = $_REQUEST['year'];
	$xueqi = $_REQUEST['xueqi'];
	$classname = $_REQUEST['classname'];
	$zhouci = $_REQUEST['zhouci'];
	$score = $_REQUEST['score'];
	$recorder = $_REQUEST['recorder'];
	if($zhouci && $recorder)
	{
		$sql = "insert into wanzixi_class (`id`,`class`,`year`,`xueqi`,`zhouci`,`score`,`recorder`,`addtime`) values (NULL,'$classname','$year','$xueqi','$zhouci','$score','$recorder','$now')";
		$a=$yiqi_db->query($sql);
		if($a)
		{
			exit("写入成功！");
		}
	}
	if($str)
		exit($str);
	else 
		exit("请输入周次和记录人信息！");
}elseif($_REQUEST['act']=='kuangke_personal')
{
	$year=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$sid=$_REQUEST['sid'];
	$name=$_REQUEST['name'];
	$classname = $_REQUEST['classname'];
	$zhouci = $_REQUEST['zhouci'];
	$kuangkekeshi = $_REQUEST['kuangkekeshi'];
	$coursename = $_REQUEST['coursename'];
	$absentriqi = $_REQUEST['absentriqi'];
	$chidaokeshi = $_REQUEST['chidaokeshi'];
	$chidaocourse = $_REQUEST['chidaocourse'];
	$chidaodate = $_REQUEST['chidaodate'];
	$zaotuikeshi = $_REQUEST['zaotuikeshi'];
	$zaotuicourse = $_REQUEST['zaotuicourse'];
	$zaotuidate = $_REQUEST['zaotuidate'];
	$recorder = $_REQUEST['recorder'];
	if($zhouci && $recorder)
	{
		$sql= "insert into stu_absent_record (`id`,`classname`,`sid`,`name`,`year`,`xueqi`,`zhouci`,`keshi`,`coursename`,`absentriqi`,`chidaokeshi`,`chidaocourse`,`chidaodate`,`zaotuikeshi`,`zaotuicourse`,`zaotuidate`,`recorder`,`addtime`) values (NULL,'$classname','$sid','$name','$year','$xueqi','$zhouci','$kuangkekeshi','$coursename','$absentriqi','$chidaokeshi','$chidaocourse','$chidaodate','$zaotuikeshi','$zaotuicourse','$zaotuidate','$recorder','$now')";
		$a=$yiqi_db->query($sql);
		if($a)
		{
		$str .= "写入成功！";
		}
	}
	if($str)
		exit($str);
	else 
		exit("请输入周次和记录人信息！");
}elseif($_REQUEST['act']=='dorm_zhian_save')
{
	$year=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$sid=$_REQUEST['sid'];
	$name=$_REQUEST['name'];
	$classname = $_REQUEST['classname'];
	$time = $_REQUEST['time'];
	$zhouci = $_REQUEST['zhouci'];
	$weiji = $_REQUEST['weiji'];
	$jibie = $_REQUEST['jibie'];
	$recorder = $_REQUEST['recorder'];
	if($year && $xueqi)
	{
		$sql= "insert into dormzhian (`id`,`class`,`year`,`xueqi`,`zhouci`,`time`,`name`,`sid`,`weiji`,`jibie`,`recorder`,`addtime`) values (NULL,'$classname','$year','$xueqi','$zhouci','$time','$name','$sid','$weiji','$jibie','$recorder','$now')";
		$a=$yiqi_db->query($sql);
		if($a)
		{
		$str .= "写入成功！";
		}
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}elseif($_REQUEST['act']=='weisheng_yuanji_save')
{
	$year=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$classname = $_REQUEST['classname'];
	$zhouci = $_REQUEST['zhouci'];
	$dormlou = "学".$_REQUEST['dormlou'];
	$dormnum = $_REQUEST['dormnum'];
	$score = $_REQUEST['score'];
	$checkdate = $_REQUEST['checkdate'];
	$recorder = $_REQUEST['recorder'];
	if($year && $xueqi)
	{
		$sql= "insert into weisheng_yuanji (`id`,`class`,`year`,`xueqi`,`zhouci`,`dormlou`,`dormnum`,`score`,`checkdate`,`recorder`,`addtime`) values (NULL,'$classname','$year','$xueqi','$zhouci','$dormlou','$dormnum','$score','$checkdate','$recorder','$now')";
		$a=$yiqi_db->query($sql);
		if($a)
		{
		$str .= "写入成功！";
		}
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}elseif($_REQUEST['act']=='weisheng_sch_save')
{
	$year=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$classname = $_REQUEST['classname'];
	$zhouci = $_REQUEST['zhouci'];
	$dormlou = "学".$_REQUEST['dormlou'];
	$dormnum = $_REQUEST['dormnum'];
	$score = $_REQUEST['score'];
	$checkdate = $_REQUEST['checkdate'];
	$recorder = $_REQUEST['recorder'];
	if($year && $xueqi)
	{
		$sql= "insert into weisheng_sch (`id`,`class`,`year`,`xueqi`,`zhouci`,`dormlou`,`dormnum`,`score`,`checkdate`,`recorder`,`addtime`) values (NULL,'$classname','$year','$xueqi','$zhouci','$dormlou','$dormnum','$score','$checkdate','$recorder','$now')";
		$a=$yiqi_db->query($sql);
		if($a)
		{
		$str .= "写入成功！";
		}
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='chufen_save')
{
	$sid=$_REQUEST['sid'];
	$classname=$_REQUEST['classname'];
	$name = $_REQUEST['name'];
	$type = $_REQUEST['type'];
	$reason = $_REQUEST['reason'];
	$wenjianhao = $_REQUEST['wenjianhao'];
	$chufendata = $_REQUEST['chufendata'];
		$sql= "insert into stu_chufen(`id`,`sid`,`classname`,`name`,`type`,`reason`,`wenjianhao`,`chufendata`,`edittime`) values (NULL,'$sid','$classname','$name','$type','$reason','$wenjianhao','$chufendata','$now')";
		$a=$yiqi_db->query($sql);
		if($a)
		{
		$str .= "写入成功！";
		}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='stu_leader')
{
	$year=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$sid=$_REQUEST['stu_id'];
	$name=$_REQUEST['name'];
	$classname = $_REQUEST['classname'];
	$org_class=$_REQUEST['org_class'];
	$org_grade=$_REQUEST['jibie'];
	$zhiwu=$_REQUEST['org_zhiwu'];
	$qq=$_REQUEST['qq'];
	$emp_time=$_REQUEST['emp_time'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	
	if($year && $xueqi)
	{
		if($org_class && $org_grade && $zhiwu)
		{
			$sql= "insert into stu_leader(`sid`,`org_class`,`org_grade`,`zhiwu`,`qq`,`emp_time`,`year`,`xueqi`,`addtime`) values ('$sid','$org_class','$org_grade','$zhiwu','$qq','$emp_time','$year','$xueqi','$datenow')";
			$a=$yiqi_db->query($sql);
			if($a)
			{
			$str .= "干部任职信息写入成功！";
			}
		}
		else
			exit("请输入完整的组织、级别和职务！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='clg_good')
{
	$sid=$_REQUEST['sid'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$yougan=$_REQUEST['yougan'];
	$sanhao=$_REQUEST['sanhao'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	
	if($xuenian && $xueqi)
	{
		if($yougan || $sanhao){
			$sql= "insert into clg_good(`sid`,`yougan`,`sanhao`,`year`,`xueqi`,`addtime`) values ('$sid','$yougan','$sanhao','$xuenian','$xueqi','$datenow')";
			$a=$yiqi_db->query($sql);
			if($a)
			{
			$str .= "院级优干三好信息写入成功！";
			}
		}
		else
			exit("请勾选任意一项优秀称号！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='cp_cla_leader')
{
	$sid=$_REQUEST['sid'];
	$cpdengji=$_REQUEST['cpdengji'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	
	if($xuenian && $xueqi)
	{
		if($cpdengji)
		{
			$sql= "insert into cp_cla_leader(`sid`,`cpdengji`,`year`,`xueqi`,`addtime`) values ('$sid','$cpdengji','$xuenian','$xueqi','$datenow')";
			$a=$yiqi_db->query($sql);
			if($a)
			{
			$str .= "班级干部测评结果写入成功！";
			}
		}
		else 
			exit("请输入测评结果！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='cp_su_ganshi')
{
	
	$sid=$_REQUEST['sid'];
	$jibie=$_REQUEST['jibie'];
	$mingcheng=$_REQUEST['mingcheng'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if($xuenian && $xueqi)
	{
		if($jibie)
		{
			$sql= "insert into cp_su_ganshi(`sid`,`jibie`,`mingcheng`,`year`,`xueqi`,`addtime`) values ('$sid','$jibie','$mingcheng','$xuenian','$xueqi','$datenow')";
			$a=$yiqi_db->query($sql);
			if($a)
			{
			$str .= "学生会干事测评结果写入成功！";
			}
		}
		else
			exit("请输入相应的级别！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='hour_su_leader')
{
	$sid=$_REQUEST['sid'];
	$jibie=$_REQUEST['jibie'];
	$mingcheng=$_REQUEST['mingcheng'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if($xuenian && $xueqi)
	{
		if($jibie && $mingcheng)
		{
			$sql= "insert into hour_su_leader(`sid`,`jibie`,`mingcheng`,`year`,`xueqi`,`addtime`) values ('$sid','$jibie','$mingcheng','$xuenian','$xueqi','$datenow')";
			$a=$yiqi_db->query($sql);
			if($a)
			{
			$str .= "学生会干部荣誉写入成功！";
			}
		}
		else
			exit("请输入完整的级别和名称！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='hour_tuan')
{
	$sid=$_REQUEST['sid'];
	$jibie=$_REQUEST['jibie'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$tuanyuan=$_REQUEST['tuanyuan'];
	$tuangan=$_REQUEST['tuangan'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	//exit("$xuenian");
	if($xuenian && $xueqi)
	{
		if($jibie)
		{
			if($tuanyuan || $tuangan)
			{
				$sql= "insert into hour_tuan(`sid`,`jibie`,`tuanyuan`,`tuangan`,`xuenian`,`xueqi`,`addtime`) values ('$sid','$jibie','$tuanyuan','$tuangan','$xuenian','$xueqi','$datenow')";
				$a=$yiqi_db->query($sql);
				if($a)
				{
				$str .= "优秀团员团干信息写入成功！";
				}
			}
			else
				exit("请勾选任意一项优秀称号！");
		}
		else
			exit("请选择相应的级别！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='hour_vol')
{
	
	$sid=$_REQUEST['sid'];
	$jibie=$_REQUEST['jibie'];
	$mingcheng=$_REQUEST['mingcheng'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if($xuenian && $xueqi)
	{
		if($jibie)
		{
			$sql= "insert into hour_vol(`sid`,`jibie`,`mingcheng`,`xuenian`,`xueqi`,`addtime`) values ('$sid','$jibie','$mingcheng','$xuenian','$xueqi','$datenow')";
			$a=$yiqi_db->query($sql);
			//exit($sql);
			if($a)
			{
			$str .= "优秀志愿者记录写入成功！";
			}
		}
		else
			exit("请输入级别信息！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='hour_grouper')
{
	$sid=$_REQUEST['sid'];
	$jibie=$_REQUEST['jibie'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$ganshi=$_REQUEST['ganshi'];
	$ganbu=$_REQUEST['ganbu'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	
	if($xuenian && $xueqi)
	{
		if($jibie)
		{
			if($ganbu || $ganshi)
			{
				$sql= "insert into hour_grouper(`sid`,`jibie`,`ganbu`,`ganshi`,`xuenian`,`xueqi`,`addtime`) values ('$sid','$jibie','$ganbu','$ganshi','$xuenian','$xueqi','$datenow')";
				$a=$yiqi_db->query($sql);
				if($a)
				{
				$str .= "优秀社团成员信息写入成功！";
				}
			}
			else
				exit("请勾选任意一项优秀称号！");
		}
		else
			exit("请选择相应的级别！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='pub_paper')
{
	$sid=$_REQUEST['sid'];
	$artname=$_REQUEST['artname'];
	$pubtime=$_REQUEST['pubtime'];
	$pubname=$_REQUEST['pubname'];
	$pubjibie=$_REQUEST['pubjibie'];
	$money=$_REQUEST['money'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if($artname && $pubtime && $pubname && $pubjibie && $money)
	{
		if($xuenian && $xueqi)
		{
			$sql= "insert into pub_paper(`sid`,`artname`,`pubtime`,`pubname`,`pubjibie`,`money`,`xuenian`,`xueqi`,`addtime`) values ('$sid','$artname','$pubtime','$pubname','$pubjibie','$money','$xuenian','$xueqi','$datenow')";
			$a=$yiqi_db->query($sql);
			if($a)
			{
			$str .= "发表文章信息写入成功！";
			}
		}
		if($str)
			exit($str);
		else 
			exit("写入失败！");
	}
	else
		exit("请输入完整的信息！");
}
elseif($_REQUEST['act']=='tech_invent')
{
	$sid=$_REQUEST['sid'];
	$type=$_REQUEST['type'];
	$content=$_REQUEST['content'];
	$time=$_REQUEST['time'];
	$danwei=$_REQUEST['danwei'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if($xuenian && $xueqi)
	{
		if($type && $content && $time && $danwei)
		{
			$sql= "insert into tech_invent(`sid`,`type`,`content`,`time`,`danwei`,`xuenian`,`xueqi`,`addtime`) values ('$sid','$type','$content','$time','$danwei','$xuenian','$xueqi','$datenow')";
			$a=$yiqi_db->query($sql);
			if($a)
			{
			$str .= "科技发明信息写入成功！";
			}
		}
		else 
			exit("请输入完整的信息！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='english')
{
	$sid=$_REQUEST['sid'];
	$thirda=$_REQUEST['thirda'];
	$thirdb=$_REQUEST['thirdb'];
	$cet4=$_REQUEST['cet4'];
	$cet6=$_REQUEST['cet6'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if(!$thirda && !$thirdb && !$cet4 && !$cet6)
	{
		
		exit("请输入任意一项英语等级考试成绩！");
	}
	else
	{
		$sql= "insert into english(`sid`,`thirda`,`thirdb`,`cet4`,`cet6`,`addtime`) values ('$sid','$thirda','$thirdb','$cet4','$cet6','$datenow')";
		$a=$yiqi_db->query($sql);
		if($a)
		{
		$str .= "英语等级考试信息写入成功！";
		}
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='computer')
{
	$sid=$_REQUEST['sid'];
	$first=$_REQUEST['first'];
	$second=$_REQUEST['second'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if(!$first && !$second)
	{
		exit("请输入任意一项计算机等级考试成绩！");
	}
	else
	{	
		$sql= "insert into computer(`sid`,`first`,`second`,`addtime`) values ('$sid','$first','$second','$datenow')";
		$a=$yiqi_db->query($sql);
		if($a)
		{
		$str .= "计算机考试等级信息写入成功！";
		}
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='qua')
{
	$sid=$_REQUEST['sid'];
	$mingcheng=$_REQUEST['mingcheng'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if($mingcheng)
	{
		$sql= "insert into qualification(`sid`,`mingcheng`,`addtime`) values ('$sid','$mingcheng','$datenow')";
		$a=$yiqi_db->query($sql);
		if($a)
		{
		$str .= "资格证书信息写入成功！";
		}
	}
	else
	{	
		exit("请输入资格证书信息！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='order')
{
	$sid=$_REQUEST['sid'];
	$mingcheng=$_REQUEST['mingcheng'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if($mingcheng == "请选择" )
	{
		exit("请输入专业排名信息！");
	}
	else
	{	
		$sql= "insert into order_info(`sid`,`mingcheng`,`xuenian`,`xueqi`,`addtime`) values ('$sid','$mingcheng','$xuenian','$xueqi','$datenow')";
		$a=$yiqi_db->query($sql);
		if($a)
		{
		$str .= "专业排名信息写入成功！";
		}
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='serve_vol')
{
	$sid=$_REQUEST['sid'];
	$jibie=$_REQUEST['jibie'];
	$content=$_REQUEST['content'];
	$serdate=$_REQUEST['serdate'];
	$sertime=$_REQUEST['sertime'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	if($sid)
	{
		if($jibie && $content && $serdate && $sertime)
		{
			$sql= "insert into serve_vol(`sid`,`jibie`,`content`,`serdate`,`sertime`,`xuenian`,`xueqi`,`addtime`) values ('$sid','$jibie','$content','$serdate','$sertime','$xuenian','$xueqi','$datenow')";
			$a=$yiqi_db->query($sql);
			//exit("$sql");
			if($a)
			{
			$str .= "志愿服务信息写入成功！";
			}
		}
		else
			exit("请输入完整的信息！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='social_practice')
{
	$sid=$_REQUEST['sid'];
	$jibie=$_REQUEST['jibie'];
	$per_jibie=$_REQUEST['per_jibie'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$datenow = date("Y-m-d H:i:s");
	if($sid)
	{
		if($jibie && $per_jibie)
		{
			$sql= "insert into social_practice(`sid`,`jibie`,`per_jibie`,`xuenian`,`xueqi`,`addtime`) values ('$sid','$jibie','$per_jibie','$xuenian','$xueqi','$datenow')";
			$a=$yiqi_db->query($sql);
			//exit("$sql");
			if($a)
			{
			$str .= "社会实践信息写入成功！";
			}
		}
		else
			exit("请输入完整的信息！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='scholarship')
{
	$sid=$_REQUEST['sid'];
	$scholarship=$_REQUEST['scholarship'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	
	if($xuenian && $xueqi)
	{
		if($scholarship)
		{
			$sql= "insert into scholarship(`sid`,`scholarship`,`year`,`xueqi`,`addtime`) values ('$sid','$scholarship','$xuenian','$xueqi','$datenow')";
			$a=$yiqi_db->query($sql);
			if($a)
			{
			$str .= "奖学金结果写入成功！";
			}
		}
		else 
			exit("请输入奖学金等级！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='schip_single')
{
	$sid=$_REQUEST['sid'];
	$jibie=$_REQUEST['jibie'];
	$xuenian=$_REQUEST['year'];
	$cause=$_REQUEST['cause'];
	$xueqi=$_REQUEST['xueqi'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	
	if($xuenian && $xueqi)
	{
		if($jibie)
		{
			$sql= "insert into schip_single(`sid`,`jibie`,`cause`,`xuenian`,`xueqi`,`addtime`) values ('$sid','$jibie','$cause','$xuenian','$xueqi','$datenow')";
			$a=$yiqi_db->query($sql);
			if($a)
			{
			$str .= "奖学金结果写入成功！";
			}
		}
		else 
			exit("请输入奖学金等级！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='sch_honour')
{
	$sid=$_REQUEST['sid'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$yougan=$_REQUEST['yougan'];
	$sanhao=$_REQUEST['sanhao'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	
	if($xuenian && $xueqi)
	{
		if($yougan || $sanhao){
			$sql= "insert into honour(`sid`,`yougan`,`sanhao`,`xuenian`,`xueqi`,`addtime`) values ('$sid','$yougan','$sanhao','$xuenian','$xueqi','$datenow')";
			$a=$yiqi_db->query($sql);
			if($a)
			{
			$str .= "校级荣誉写入成功！";
			}
		}
		else
			exit("请勾选任意一项优秀称号！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
elseif($_REQUEST['act']=='buwenming')
{
	$sid=$_REQUEST['sid'];
	$xuenian=$_REQUEST['year'];
	$xueqi=$_REQUEST['xueqi'];
	$content=$_REQUEST['content'];
	$zhouci=$_REQUEST['zhouci'];
	$recorder=$_REQUEST['recorder'];
	$time = $_REQUEST['time'];
	$datenow = date("Y-m-d H:i:s");
	
	if($recorder && $zhouci)
	{
		if($content || $time){
			$sql= "insert into buwenming(`sid`,`time`,`content`,`zhouci`,`recorder`,`xuenian`,`xueqi`,`addtime`) values ('$sid','$time','$content','$zhouci','$recorder','$xuenian','$xueqi','$datenow')";
			$a=$yiqi_db->query($sql);
			if($a)
			{
			$str .= "其他不文明行为写入成功！";
			}
		}
		else
			exit("请填写完整的录入信息！");
	}
	if($str)
		exit($str);
	else 
		exit("写入失败！");
}
?>
