<?php
require_once("ezsql/ez_sql_core.php");
require_once("ezsql/ez_sql_mysql.php");
require_once("config.inc.php");
if(phpversion() > '5.1.0')
    date_default_timezone_set('Asia/Shanghai');

$yiqi_db = new ezSQL_mysql($cfg_db_user,$cfg_db_pass,$cfg_db_name,$cfg_db_host);
$yiqi_db->query("set names 'utf8'");
$mysqlversion = $yiqi_db->get_var("select VERSION();");
if($mysqlversion > '5.0.1')
{
    $yiqi_db->query("SET sql_mode=''");
}
//This stops SQL Injection in POST vars 
foreach ($_POST as $key => $value) { 
    if(is_array($value))
    {
        foreach($value as $k=>$v)        
            $value[$k] = $yiqi_db->escape($v);        
        $_POST[$key] = $value;
    }
    else
    {
        $_POST[$key] = $yiqi_db->escape($value);
    } 
}
//This stops SQL Injection in GET vars 
foreach ($_GET as $key => $value) { 
    if(is_array($value))
    {
        foreach($value as $k=>$v)
            $value[$k] = $yiqi_db->escape($v);
        $_GET[$key] = $value;
    }
    else
    {
        $_GET[$key] = $yiqi_db->escape($value); 
    }
}

function CheckSql($sql)
{
    global $yiqi_db;
    global $cfg_db_prefix;
    $sql = str_replace("yiqi_",$cfg_db_prefix,$sql);
    return $sql;
}
function globalpara($table,$back=0,$type="in")
{
		//0:id => name  1:name=>id
    global $yiqi_db;
		$sql = "select * from $table where 1";
		//$sql .= ($table == "class" && $type == "in")? " and status=0 " : "" ;
		$result = $yiqi_db->get_results($sql);
		$data = array();
		if(count($result) > 0){
			foreach($result as $v){
				if($back == 0)
					$data[$v->id] = $v->name;
				else
					$data[$v->name] = $v->id;
			}
		}
    return $data;
}
?>
