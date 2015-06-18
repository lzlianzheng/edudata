<?php
require_once 'include/common.inc.php';
require_once 'include/user.class.php';
session_start();

$id = $_SESSION["adminid"];
$id = (isset($id) && is_numeric($id)) ? $id : 0;

$userdata = new User;
$adminuserinfo = $userdata->GetUser($id);
if($adminuserinfo == null)
{
   exit("您没有权限执行管理,请<a href=\"login.php\">登录</a>!");    
}
$uid = $adminuserinfo->uid;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title;?></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="images/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="images/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="./images/motion.js"></script>
<script type="text/javascript" src="./images/load.js"></script>
<script type="text/javascript" src="./images/jquery.form.js"></script>
<script type="text/javascript">
function delete_confirm(e) 
{
    if (event.srcElement.outerText == "删除") 
    {
        event.returnValue = confirm("删除是不可恢复的，你确认要删除吗？");
    }
}
document.onclick = delete_confirm;
</script>
</head>
<body>
 <div class="wrap">
      <div class="header">
      </div>

	<div id="main_nav">
          <?php include("leftnav.php");?>
          <script type="text/javascript" src="./images/ddaccordion.js">
          </script>
          <script type="text/javascript">
            ddaccordion.init({
              headerclass: "submenuheader",
              contentclass: "submenu",
              revealtype: "click",
              mouseoverdelay: 200,
              collapseprev: true,
              defaultexpanded: [],
              onemustopen: false,
              animatedefault: false,
              persiststate: true,
              toggleclass: ["", ""],
              togglehtml: ["suffix", "", ""],
              animatespeed: "fast",
              oninit: function(headers, expandedindices) {
                //do nothing
              },
              onopenclose: function(header, index, state, isuseractivated) {
                //do nothing
              }
            });
          </script>
	</div>
	<div id="main_nav" style = "float:right" >
          <?php include("rightnav.php");?>
          <script type="text/javascript" src="./images/ddaccordion.js">
          </script>
      </div>
	  
<div class="mainc">
	<div class="prompt">
		<b><?php echo "当前位置：后台管理  》  ".$title;?></b>
 	</div>           
