<?php
require_once 'include/user.class.php';

$uid = $_GET["uid"];
$uid = (isset($uid) && is_numeric($uid)) ? $uid : 0;

$userdata = new User;
$userinfo = $userdata->GetUser($uid);
if($userinfo==null)
{
    header("location:users.php");exit();
}
$action = $_POST["action"];
if($action == "save")
{
    $userpass = $_POST["userpass"];
    $useremail = $_POST["useremail"];
    $usergender = $_POST["usergender"];
    $regular = $_POST["regular"];

    if(empty($useremail))
    {
        $useremail = $userinfo->email;
    }
    
    if(empty($userpass))
    {
        $userpass = $userinfo->password;
    }
    else
    {
        $userpass = md5($userpass);
    }
    if(empty($usergender))
    {
        $usergender = 0 ;
    }    
    $nowdate = date("Y-m-d H:i:s");
    $sql = "UPDATE yiqi_users2 SET password='$userpass',gender='$usergender',email='$useremail',regular='".implode("|",$regular)."' WHERE uid = '$userinfo->uid' limit 1";           
    $result = $yiqi_db->query(CheckSql($sql));
    exit("用户资料已编辑");
}
?>
<?php
$title = "编辑管理员信息";
include("header.php");?>
<div class="list5">
<form id="sform" action="" method="post">
<table class="inputform list5" cellpadding="1" cellspacing="1">
<tr><td class="label">用户名称</td><td class="input"><?php echo $userinfo->username;?></td></tr>
<tr><td class="label">用户密码</td><td class="input"><input type="text" class="txt" name="userpass" />&nbsp;不改请留空</td></tr>
<tr><td class="label">电子邮箱</td><td class="input"><input type="text" class="txt" name="useremail" value="<?php echo $userinfo->email;?>" /></td></tr>
<tr><td class="label">性别</td><td class="input"><select name="usergender"><option value="0">请选择</option><option value="1">男</option><option value="2">女</option></select></td></tr>
<tr><td class="label"></td><td class="input"><input type="hidden" name="action" value="save" /><input id="submitbtn" type="submit" class="subtn" value="提交" /></td></tr>
</table>
</form>
</div>

<script type="text/javascript">
$(function(){
    $("select[name='usergender'] option").each(function(){
    	if($(this).val()==<?php echo $userinfo->gender;?>)
    	{
    		$(this).attr("selected","selected");
    	}
    });
	var formoptions = {
		beforeSubmit: function() {
			$("#submitbtn").val("正在处理...");
			$("#submitbtn").attr("disabled",true);
		},
		success: function (msg) {
			alert(msg);
			$("#submitbtn").val("提交");
			$("#submitbtn").attr("disabled",false);
		}
	};
	$("#sform").ajaxForm(formoptions);
});
	
</script>
<?php include("footer.php");?>
</body>

</html>
