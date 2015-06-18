<?php

function ShowMsg($msg,$redirect='')
{
    if($redirect == 'back')
    {
        echo "<script>alert('$msg');window.history.go(-1);</script>";
    }
		else if($redirect != ""){
        echo "<script>alert('$msg');window.location.href='$redirect';</script>";
		}else
    {
        $redirect = $_SERVER["REQUEST_URI"];
        echo "<script>alert('$msg');window.location.href='$redirect';</script>";
    }
}

function ExitMsg($msg,$redirect='')
{
    if($redirect == 'back')
    {
        exit("<script>alert('$msg');window.history.go(-1);</script>");
    }
    else
    {
        $redirect = $_SERVER["REQUEST_URI"];
        exit("<script>alert('$msg');window.location.href='$redirect';</script>");
    }
}

function safeCheck($str) 
{ 
    $farr = array( 
        "/\s+/",                                                                                            //过滤多余的空白 
        "/<(\/?)(script|i?frame|style|html|body|title|link|meta|\?|\%)([^>]*?)>/isU",  //过滤 <script 等可能引入恶意内容或恶意改变显示布局的代码,如果不需要插入flash等,还可以加入<object的过滤 
        "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",                                      //过滤javascript的on事件 
      
   ); 
   $tarr = array( 
        "", 
        "", 
        "", 
   ); 

  $str = preg_replace($farr,$tarr,$str); 
   return $str; 
}

function pager($total,$current,$url)
{
 	$more = '...';
	$pagerhtml = '<a href="'.$url.'p=1">首页</a>'; 
	if($total <= 5)
	{
	 	for($i = 1; $i <= $total; $i++)
	 	{
	 		if($i == $current)
			{
				$pagerhtml .= '<span>'.$i.'</span>'; 
			}
			else
		 	{
				$pagerhtml .= '<a href="'.$url.'p='.$i.'">'.$i.'</a>'; 
			}
		}
	}
	else
	{
		if($current == 1 || $current == 2)
	 	{
		 	for($i = 1; $i <= 5; $i++)
		 	{
			 	if($i == $current)
			 	{
					$pagerhtml .= '<span>'.$i.'</span>'; 
				}
				else
			 	{
					$pagerhtml .= '<a href="'.$url.'p='.$i.'">'.$i.'</a>'; 
				}
			}
			if($i <= $total){$pagerhtml .= $more;}
		}
		else if($current == $total || $current == $total - 1)
	 	{
		 	if($current >= 5){$pagerhtml .= $more;}
		 	for($i = $total - 4; $i <= $total; $i++)
		 	{
			 	if($i == $current)
			 	{
					$pagerhtml .= '<span>'.$i.'</span>'; 
				}
				else
			 	{
					$pagerhtml .= '<a href="'.$url.'p='.$i.'">'.$i.'</a>'; 
				}
			}
		}
		else
	 	{
		 	if($current >= 4){$pagerhtml .= $more;}
		 	for($i = $current - 2; $i <= $current + 2; $i++)
		 	{
		 		if($i == $current)
			 	{
					$pagerhtml .= '<span>'.$i.'</span>'; 
				}
				else
			 	{
					$pagerhtml .= '<a href="'.$url.'p='.$i.'">'.$i.'</a>'; 
				}
			}
			if($i <= $total){$pagerhtml .= $more;}
		}
	}
	$pagerhtml .= '<a href="'.$url.'p='.$total.'">末页</a>'; 
	return $pagerhtml;
}
$mountharr = array("01"=>"一", "02"=>"二", "03"=>"三", "04"=>"四", "05"=>"五", "06"=>"六", "07"=>"七", "08"=>"八", "09"=>"九", "10"=>"十", "11"=>"十一", "12"=>"十二");
$edukey = array();
$edukey['table_name'] = array("student"=>"student_info","xueshenghui"=>"xueshenghui","class"=>"class","type"=>"student_type","nation"=>"nation","major"=>"major","cteacher"=>"cteacher");
$edukey['student'] = array(
	"sid"               =>"学号",
	"classid"          =>"班级",
	"name"             =>"姓名",
	"sex"              =>"性别",
	"identity"         =>"身份证",
	"birthday"         =>"生日",
	"photo"            =>"照片",
	"nationid"         =>"民族",
	"native"           =>"籍贯",
	"homeaddress"      =>"家庭地址",
	"zipcode"          =>"邮编",
	"mobilephone"      =>"电话",
	"dormbn"           =>"宿舍楼",
	"dormnumber"       =>"宿舍号",
	"fathername"       =>"父亲",
	"fathermobilephone"=>"父亲电话",
	"mathername"       =>"母亲",
	"mathermobilephone"=>"母亲电话",
	"type"             =>"学生类型",
	"status"           =>"状态",
	"initial"          =>"Initial"
);
$edukey['class'] = array(
	"id"         =>"编号",
	"name"       =>"班级",
	"majorid"    =>"专业",
	"classroom"  =>"教室",
	"capacity"   =>"人数",
	"deanteacher"=>"班主任",
	"d_mobile1"    =>"班主任电话",
	"monitor"    =>"班长",
	"m_mobile2"    =>"班长电话",
	"c_sum"    =>"人数统计"
);
$edukey['xueshenghui'] = array(
	"jieci" =>"界次",
	"zhiwu" =>"职务",
	"name"  =>"姓名",
	"class" =>"班级",
	"phone" =>"电话"
);
$edukey['nation'] = array(
	"id"   =>"编号",
	"name" =>"民族"
);
$edukey['stu_type'] = array(
	"id"   =>"编号",
	"name" =>"类型"
);
$edukey['major'] = array(
	"id"   =>"编号",
	"name" =>"名称"
);
$edukey['cteacher'] = array(
	"id"       =>"序号",
	"name"     =>"姓名",
	"tid"      =>"工号",
	"sex"      =>"性别",
	"birthday" =>"出生年月",
	"zhengzhi" =>"政治面貌",
	"xueli"    =>"学历",
	"zhicheng" =>"职称",
	"worktime" =>"聘任时间",
	"bumen"    =>"工作部门",
	"zhiwu"    =>"职务级别",
	"zhuanjian"=>"专兼职",
	"mobile"   =>"联系方式"
);
$yeardata = array('2011-2012','2012-2013','2013-2014','2014-2015','2015-2016','2016-2017','2017-2018','2018-2019','2019-2020','2020-2021');
$weijiarr = array('夜不归宿','晚归','烟头','大功率违章电器','打火机');
$star_score = array("0","3","4","5","6","8");
$limitsql = 2;
$panduan = NULL;
?>
