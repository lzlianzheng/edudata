<?php
require_once 'include/common.inc.php';
$cid=$_GET["cid"];
$list = $yiqi_db->get_results("select * from student_info where classid='$cid' ");
if(count($list) > 0){
	echo "<table class='t_list list4'><tr><td>学号</td><td>姓名</td><td>性别</td><td>宿舍</td><td>学生类型</td></tr>";
	foreach($list as $v){
		echo "<tr>
						<td>$v->sid</td>
						<td><a href='stuinfo.php?sid=$v->sid'>$v->name</a></td>
						<td>$v->sex</td>
						<td>$v->dormbn - $v->dormnumber</td>
						<td>$v->type</td>
					</tr>";	
	}
	echo "</table>";
}
?>
