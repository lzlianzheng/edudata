<?php	
	require_once 'include/user.class.php';
	session_start();
	$id = $_SESSION["adminid"];
	$userdata = new User;
	$adminuserinfo = $userdata->GetUser($id);
	$uid = $adminuserinfo->uid;
?>