<?php
require_once 'data.class.php';

class Link
{
    function GetLink($lid)
    {
        global $yiqi_db;
	    if($this->ExistLink($lid)==1)
	    {
	        $sql = "select * from yiqi_link where lid = '$lid' limit 1";
	        return $yiqi_db->get_row(CheckSql($sql));
	    }
	    else
	    {
	        return null;
	    }
    }
    
    function ExistLink($lid)
	{
	    global $yiqi_db;
	    $sql = "select * from yiqi_link where lid = '$lid' limit 1";	    
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
	
    function GetLinkList($orderby="displayorder")
	{
	    global $yiqi_db;
		return $yiqi_db->get_results(CheckSql("select * from yiqi_link where status = 'ok' and remark = '0' order by $orderby"));
	}
	
	function TakeLinkList($skip=0,$take=10,$orderby="displayorder")
	{
	    global $yiqi_db;
		return $yiqi_db->get_results(CheckSql("select * from yiqi_link where status = 'ok' and remark = '0' order by $orderby limit $skip,$take"));		
	}

    function GetClientList($c=100,$orderby="displayorder")
	{
	    global $yiqi_db;
			$remark = ($c >= 100)? " remark>10 " : " remark='$c' ";
		return $yiqi_db->get_results(CheckSql("select * from yiqi_link where status = 'ok' and $remark order by $orderby"));
	}
	
	function TakeClientList($c=100,$skip=0,$take=10,$orderby="displayorder")
	{
	    global $yiqi_db;
			$remark = ($c >= 100)? " remark>10 " : " remark='$c' ";
		return $yiqi_db->get_results(CheckSql("select * from yiqi_link where status = 'ok' and $remark order by $orderby limit $skip,$take"));		
	}

    function GetServiceList($orderby="displayorder")
	{
	    global $yiqi_db;
		return $yiqi_db->get_results(CheckSql("select * from yiqi_link where status = 'ok' and remark = '1' order by $orderby"));
	}
	
	function TakeServiceList($skip=0,$take=10,$orderby="displayorder")
	{
	    global $yiqi_db;
		return $yiqi_db->get_results(CheckSql("select * from yiqi_link where status = 'ok' and remark = '1' order by $orderby limit $skip,$take"));		
	}
}
?>
