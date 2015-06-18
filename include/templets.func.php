<?php

function formaturl($params)
{
    global $yiqi_db;
    extract($params);
    $sql = "select * from yiqi_settings where varname = 'urlrewrite' limit 1";
    $result = $yiqi_db->get_row(CheckSql($sql));
	$name = urlencode($name);
    if($result->value == "true")
    {
        switch($type)
        {
            case "category":
                if(is_numeric($page))
                    $urlinfo = "category/$name"."_"."$page/";                    
                else
                    $urlinfo = "category/$name/";
                break;
            case "article":
                $urlinfo = "article/$name.html";
                break;
            case "product":
                $urlinfo = "product/$name.html";
                break;
            case "rencai":
                $urlinfo = "rencai/$name.html";
                break;
            case "catalog":
								if(is_numeric($page))
								    $urlinfo = "catalog/$name"."_"."$page/";
								else
									  $urlinfo = "catalog/$name/";
                break;
            case "comment":
                $urlinfo = "comment.php";
                break;
            case "commentlist":
								if(is_numeric($page))
								    $urlinfo = "commentlist"."_"."$page/";
								else
                		$urlinfo = "commentlist.php";
                break;
            case "download":
								if(is_numeric($page))
								    $urlinfo = "download"."_"."$page/";
								else
                		$urlinfo = "download.php";
                break;
			case "sitemap":
				$urlinfo = "sitemap.xml";
				break;
        }
    }
    else
    {
        switch($type)
        {
            case "category":
                if(is_numeric($page))
                    $urlinfo = "category.php?name=$name&p=$page";                    
                else
                    $urlinfo = "category.php?name=$name";
                break;
            case "article":
                $urlinfo = "article.php?name=$name";
                break;
            case "product":
                $urlinfo = "product.php?name=$name";
                break;
            case "rencai":
                $urlinfo = "rencai.php?name=$name";
                break;
            case "catalog":
								if(is_numeric($page))
										$urlinfo = "catalog.php?type=$name&p=$page";
								else
										$urlinfo = "catalog.php?type=$name";
                break;
            case "commentlist":
								if(is_numeric($page))
										$urlinfo = "commentlist.php?p=$page";
								else
										$urlinfo = "commentlist.php";
                break;
            case "download":
								if(is_numeric($page))
										$urlinfo = "download.php?p=$page";
								else
										$urlinfo = "download.php";
                break;
            case "comment":
                $urlinfo = "comment.php";
                break;
			case "sitemap":
                $urlinfo = "sitemap.php";
                break;
        }
    }
    return $siteurl."/".$urlinfo;
}
?>
