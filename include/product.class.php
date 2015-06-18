<?php

require_once("data.class.php");
require_once("category.class.php");

class Product
{
	function GetProduct($pid,$all=false)
	{
	    global $yiqi_db;
	    if($this->ExistProduct($pid,$all)==1)
	    {
			if($all)
			{
				 return $yiqi_db->get_row(CheckSql("select * from yiqi_product where pid = '$pid' limit 1"));
			}
			else
			{
				 return $yiqi_db->get_row(CheckSql(sprintf("select * from yiqi_product where pid = '$pid' and adddate <= '%s' limit 1",date("Y-m-d H:i:s"))));
			}
	    }
	    else
	    {
	        return null;
	    }
	}
	
    function GetProductByName($name,$all=false)
	{
	    global $yiqi_db;
	    if($this->ExistFilename($name,$all))
	    {
			if($all)
			{
				 return $yiqi_db->get_row(CheckSql("select * from yiqi_product where filename = '$name' limit 1"));
			}
			else
			{
				 return $yiqi_db->get_row(CheckSql(sprintf("select * from yiqi_product where filename = '$name' and adddate <= '%s' limit 1",date("Y-m-d H:i:s"))));
			}
	    }
	    else
	    {
	        return null;
	    }
	}
	
	function ExistProduct($pid,$all=false)
	{
	    global $yiqi_db;
		$sql = '';
		if($all)
		{
			$sql = "select * from yiqi_product where pid = '$pid' limit 1";
		}
		else
		{
			$sql = sprintf("select * from yiqi_product where pid = '$pid' and adddate <= '%s' limit 1",date("Y-m-d H:i:s"));	    
		}
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
	
    function ExistFilename($filename,$all=false)
	{
	    global $yiqi_db;
		$sql = '';
		if($all)
		{
			$sql = "select * from yiqi_product where filename = '$filename' limit 1";
		}
		else
		{
			$sql = sprintf("select * from yiqi_product where filename = '$filename' and adddate <= '%s' limit 1",date("Y-m-d H:i:s"));
		}
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
	
	function GetProductAllList($cid,$orderby="adddate desc",$all=false)
	{
	    global $yiqi_db;
	    $categorydata = new Category();	    
    	$exist = $categorydata->ExistCategory($cid);
		if($exist == 1)
		{
			if($all)
			{
				return $yiqi_db->get_results(CheckSql("select * from yiqi_product where cid = '$cid' or cid in (select cid from yiqi_category where pid = '$cid') order by $orderby "));
			}
			else
			{
				return $yiqi_db->get_results(CheckSql(sprintf("select * from yiqi_product where (cid = '$cid' or cid in (select cid from yiqi_category where pid = '$cid')) and adddate <= '%s' order by $orderby ",date("Y-m-d H:i:s"))));
			}
		}
		else
		{
			if($all)
			{
				return $yiqi_db->get_results(CheckSql("select * from yiqi_product order by $orderby"));
			}
			else
			{
				return $yiqi_db->get_results(CheckSql(sprintf("select * from yiqi_product where adddate <= '%s' order by $orderby",date("Y-m-d H:i:s"))));
			}
		}
	}
	
	function TakeProductAllList($cid=0,$skip=0,$take=10,$orderby="adddate desc",$all=false)
	{
	    global $yiqi_db;
	    $categorydata = new Category();	    
    	$exist = $categorydata->ExistCategory($cid);
		if($exist == 1)
		{
			if($all)
			{
				return $yiqi_db->get_results(CheckSql("select distinct * from yiqi_product where cid = '$cid' or cid in (select cid from yiqi_category where pid = '$cid') order by $orderby limit $skip,$take "));
			}
			else
			{
				return $yiqi_db->get_results(CheckSql(sprintf("select distinct * from yiqi_product where (cid = '$cid' or cid in (select cid from yiqi_category where pid = '$cid')) and adddate <= '%s' order by $orderby limit $skip,$take ",date("Y-m-d H:i:s"))));
			}
		}
		else
		{
			if($all)
			{
				return $yiqi_db->get_results(CheckSql("select * from yiqi_product order by $orderby limit $skip,$take"));
			}
			else
			{
				return $yiqi_db->get_results(CheckSql(sprintf("select * from yiqi_product where adddate <= '%s' order by $orderby limit $skip,$take",date("Y-m-d H:i:s"))));
			}
		}
	}
	
	function GetProductList($type=0,$cid,$orderby="adddate desc",$all=false)
	{
	    global $yiqi_db;
	    $categorydata = new Category();	    
    	$exist = $categorydata->ExistCategory($cid);
		if($exist == 1)
		{
			if($all)
			{
				return $yiqi_db->get_results(CheckSql("select * from yiqi_product where type = '$type' and (cid = '$cid' or cid in (select cid from yiqi_category where pid = '$cid')) order by $orderby "));
			}
			else
			{
				return $yiqi_db->get_results(CheckSql(sprintf("select * from yiqi_product where type = '$type' and (cid = '$cid' or cid in (select cid from yiqi_category where pid = '$cid')) and adddate <= '%s' order by $orderby ",date("Y-m-d H:i:s"))));
			}
		}
		else
		{
			if($all)
			{
				return $yiqi_db->get_results(CheckSql("select * from yiqi_product where type = '$type' order by $orderby"));
			}
			else
			{
				return $yiqi_db->get_results(CheckSql(sprintf("select * from yiqi_product where type = '$type' and adddate <= '%s' order by $orderby",date("Y-m-d H:i:s"))));
			}
		}
	}
	
	function TakeProductList($type=0,$cid=0,$skip=0,$take=10,$orderby="adddate desc",$all=false)
	{
	    global $yiqi_db;
	    $categorydata = new Category();	    
    	$exist = $categorydata->ExistCategory($cid);
		if($exist == 1)
		{
			if($all)
			{
				return $yiqi_db->get_results(CheckSql("select distinct * from yiqi_product where type = '$type' and (cid = '$cid' or cid in (select cid from yiqi_category where pid = '$cid')) order by $orderby limit $skip,$take "));
			}
			else
			{
				return $yiqi_db->get_results(CheckSql(sprintf("select distinct * from yiqi_product where type = '$type' and (cid = '$cid' or cid in (select cid from yiqi_category where pid = '$cid')) and adddate <= '%s' order by $orderby limit $skip,$take ",date("Y-m-d H:i:s"))));
			}
		}
		else
		{
			if($all)
			{
				return $yiqi_db->get_results(CheckSql("select * from yiqi_product where type = '$type' order by $orderby limit $skip,$take"));
			}
			else
			{
				return $yiqi_db->get_results(CheckSql(sprintf("select * from yiqi_product where type = '$type' and adddate <= '%s' order by $orderby limit $skip,$take",date("Y-m-d H:i:s"))));
			}
		}
	}
	
    function TakeProductListByName($type=0,$name="",$skip=0,$take=10,$orderby="adddate desc",$all=false)
	{
	    global $yiqi_db;
	    $categorydata = new Category();	    
    	$exist = $categorydata->ExistFilename($name);
		if($exist == 1)
		{
		    $category = $categorydata->GetCategoryByName($name);
			if($all)
			{
				return $yiqi_db->get_results(CheckSql("select distinct * from yiqi_product where type = '$type' and (cid = '$category->cid' or cid in (select cid from yiqi_category where pid = '$category->cid')) order by $orderby limit $skip,$take "));
			}
			else
			{
				return $yiqi_db->get_results(CheckSql(sprintf("select distinct * from yiqi_product where type = '$type' and (cid = '$category->cid' or cid in (select cid from yiqi_category where pid = '$category->cid')) and adddate <= '%s' order by $orderby limit $skip,$take ",date("Y-m-d H:i:s"))));
			}
		}
		else
		{
			if($all)
			{
				return $yiqi_db->get_results(CheckSql("select * from yiqi_product where type = '$type' order by $orderby limit $skip,$take"));
			}
			else
			{
				return $yiqi_db->get_results(CheckSql(sprintf("select * from yiqi_product where type = '$type' and adddate <= '%s' order by $orderby limit $skip,$take",date("Y-m-d H:i:s"))));
			}
		}
	}
	
    function UpdateCount($pid)
	{
	    global $yiqi_db;
	    $sql = "UPDATE yiqi_product SET viewcount = viewcount+1 where pid = '$pid' limit 1";
	    $yiqi_db->query(CheckSql($sql));
	}
	
	function GetSearchList($name,$orderby="adddate desc")
	{
			global $yiqi_db;
			$nowdate = date("Y-m-d H:i:s");
				return $yiqi_db->get_results(CheckSql("select * from yiqi_product where name like '%$name%' and adddate <= '$nowdate' order by $orderby"));
	}
	
	function TakeSearchList($name,$skip=0,$take=10,$orderby="adddate desc")
	{
	    global $yiqi_db;
			$nowdate = date("Y-m-d H:i:s");
				return $yiqi_db->get_results(CheckSql("select * from yiqi_product where name like '%$name%' and adddate <= '$nowdate' order by $orderby limit $skip,$take"));
	}

	function TakeProductTop($cid=0,$skip=0,$take=1000,$orderby="adddate desc",$all=false)
	{
	    global $yiqi_db;
	    $categorydata = new Category();	    
    	$exist = $categorydata->ExistCategory($cid);
		if($exist == 1)
		{
			if($all)
			{
				return $yiqi_db->get_results(CheckSql("select distinct * from yiqi_product where (cid = '$cid' or cid in (select cid from yiqi_category where pid = '$cid')) and top = '1' order by $orderby limit $skip,$take "));
			}
			else
			{
				return $yiqi_db->get_results(CheckSql(sprintf("select distinct * from yiqi_product where (cid = '$cid' or cid in (select cid from yiqi_category where pid = '$cid')) and adddate <= '%s' and top = '1' order by $orderby limit $skip,$take ",date("Y-m-d H:i:s"))));
			}
		}
		else
		{
			if($all)
			{
				return $yiqi_db->get_results(CheckSql("select * from yiqi_product where top = '1' order by $orderby limit $skip,$take"));
			}
			else
			{
				return $yiqi_db->get_results(CheckSql(sprintf("select * from yiqi_product where adddate <= '%s' and top = '1' order by $orderby limit $skip,$take",date("Y-m-d H:i:s"))));
			}
		}
	}
	
	function TakeRollboxList($type=0,$cid=0,$skip=0,$take=10,$orderby="adddate desc",$all=false)
	{
	    global $yiqi_db;
	    $categorydata = new Category();	    
    	$exist = $categorydata->ExistCategory($cid);
		if($exist == 1)
		{
			if($all)
			{
				return $yiqi_db->get_results(CheckSql("select distinct p.name,p.filename,p.thumb,c.filename as cfilename from yiqi_product p,yiqi_category c where p.type = '$type' and (p.cid = '$cid' or p.cid in (select cid from yiqi_category where pid = '$cid')) and p.cid = c.cid order by $orderby limit $skip,$take "));
			}
			else
			{
				return $yiqi_db->get_results(CheckSql(sprintf("select distinct p.name,p.filename,p.thumb,c.filename as cfilename from yiqi_product p,yiqi_category c where p.type = '$type' and (p.cid = '$cid' or p.cid in (select cid from yiqi_category where pid = '$cid')) and p.cid = c.cid and p.adddate <= '%s' order by $orderby limit $skip,$take ",date("Y-m-d H:i:s"))));
			}
		}
		else
		{
			if($all)
			{
				return $yiqi_db->get_results(CheckSql("select distinct p.name,p.filename,p.thumb,c.filename as cfilename from yiqi_product p,yiqi_category c where p.type = '$type' and p.cid = c.cid order by $orderby limit $skip,$take"));
			}
			else
			{
				return $yiqi_db->get_results(CheckSql(sprintf("select distinct p.name,p.filename,p.thumb,c.filename as cfilename from yiqi_product p,yiqi_category c where p.type = '$type' and p.cid = c.cid and p.adddate <= '%s' order by $orderby limit $skip,$take",date("Y-m-d H:i:s"))));
			}
		}
	}
}
?>
