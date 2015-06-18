<?php

require_once("data.class.php");

class User
{
    function GetUser($id=0)
    {
        global $yiqi_db;
	    if($this->ExistUser($id)==1)
	    {
	        $sql = "select * from yiqi_users2 where id = '$id' limit 1";
	        return $yiqi_db->get_row(CheckSql($sql));
	    }
	    else
	    {
	        return null;
	    }
    }
    
    function GetUserByName($username)
    {
        global $yiqi_db;
        $sql = "select * from yiqi_users2 where username = '$username' limit 1";
        return $yiqi_db->get_row(CheckSql($sql));
    }
    
    function ExistUser($id)
	{
	    global $yiqi_db;
	    $sql = "select * from yiqi_users2 where id = '$id' limit 1";	    
	    $exist = $yiqi_db->query(CheckSql($sql));
	    if($exist == 0)
	    {
	        return 0;
	    }
	    else
	    {
	        return 1;
	    }	    
	}
	
	function ExistUserPassword($username,$password)
	{
	    global $yiqi_db;
	    $password = md5($password);
	    $sql = "select * from yiqi_users2 where username = '$username' and password = '$password' limit 1";	    
	    $exist = $yiqi_db->query(CheckSql($sql));
	    if($exist == 0)
	    {
	        return 0;
	    }
	    else
	    {
	        return 1;
	    }
	}
	
    function GetUserList()
	{
	    global $yiqi_db;
		return $yiqi_db->get_results(CheckSql("select * from yiqi_users2 order by adddate desc,id desc"));
	}
	
	function TakeUserList($skip=0,$take=10)
	{
	    global $yiqi_db;
		return $yiqi_db->get_results(CheckSql("select * from yiqi_users2 order by adddate desc,id desc limit $skip,$take"));		
	}

    function GetMember($id=0)
    {
        global $yiqi_db;
	    if($this->ExistMember($id)==1)
	    {
	        $sql = "select * from jiameng where id = '$id' limit 1";
	        return $yiqi_db->get_row(CheckSql($sql));
	    }
	    else
	    {
	        return null;
	    }
    }
    
    function GetMemberByName($username)
    {
        global $yiqi_db;
        $sql = "select * from jiameng where username = '$username' limit 1";
        return $yiqi_db->get_row(CheckSql($sql));
    }
    
    function ExistMember($id)
	{
	    global $yiqi_db;
	    $sql = "select * from jiameng where id = '$id' limit 1";	    
	    $exist = $yiqi_db->query(CheckSql($sql));
	    if($exist == 0)
	    {
	        return 0;
	    }
	    else
	    {
	        return 1;
	    }	    
	}
	
	function ExistMemberPassword($username,$password)
	{
	    global $yiqi_db;
	    $password = md5($password);
	    $sql = "select * from jiameng where username = '$username' and password = '$password' limit 1";	    
	    $exist = $yiqi_db->query(CheckSql($sql));
	    if($exist == 0)
	    {
	        return 0;
	    }
	    else
	    {
	        return 1;
	    }
	}
	
    function GetMemberList()
	{
	    global $yiqi_db;
		return $yiqi_db->get_results(CheckSql("select * from jiameng order by adddate desc,id desc"));
	}
	
	function TakeMemberList($skip=0,$take=10)
	{
	    global $yiqi_db;
		return $yiqi_db->get_results(CheckSql("select * from jiameng order by adddate desc,id desc limit $skip,$take"));		
	}
}
?>
