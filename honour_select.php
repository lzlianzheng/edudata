<?php
require_once 'include/common.inc.php';
if($_GET['act']=='stat'|| $_GET["act"] == 'out')
{
$s_major=$_GET["s_major"];
$s_year=$_GET["s_year"];
$s_class = $_GET["s_class"];
$xuenian = $_GET["xuenian"];
$xueqi = $_GET["xueqi"];
$honour=$_GET["honour"];
if($xuenian && $xueqi)
{
	$sql="select a.honourname,a.jibie,a.sid,b.name,b.classid,c.name as classname from stuhonour a left join student_info b on a.sid=b.sid left join class c on b.classid=c.id where 1";
	if($honour)
		$sql .=" and a.jibie like '$honour%' "; 		
	if($xueqi)
		$sql .= " and a.xueqi=$xueqi";
	if($xuenian)
		$sql .= " and a.year='$xuenian'";
	if($s_year)
		$sql .=" and c.year= '$s_year' ";
	if($s_major)
		$sql .=" and c.majorid='$s_major'";		
	if($s_class)
		$sql .=" and c.id= '$s_class' ";
$result=$yiqi_db->get_results($sql);
$classarr = array();
$sidarr = array();
$namearr = array();
$data = array();
if(count($result) > 0){
foreach($result as $v){
	if(!in_array($v->classid,$classarr)){
		array_push($classarr,$v->classid);
		$data[$v->classid] = array();
		$data[$v->classid]["classname"] = $v->classname;
		$data[$v->classid]["dlist"] = array();
	}
	if(!in_array($v->classid."__".$v->sid,$sidarr)){
		array_push($sidarr,$v->classid."__".$v->sid);
		$data[$v->classid]["dlist"][$v->sid] = array();	
	}
	
	//$data[$v->classid]["dlist"][$v->name]["x"] = $x;
	//$data[$v->classid]["dlist"][$v->name]["y"] = $y;
	if(!in_array($v->classid."__".$v->sid."__".$v->name,$namearr))
	{	
		array_push($namearr,$v->classid."__".$v->sid."__".$v->name);
		$data[$v->classid]["dlist"][$v->sid]["name"] = $v->name;
		$data[$v->classid]["dlist"][$v->sid]["hlist"] = array();
		$x = "";
		$y = "";
	}
	if($v->jibie == "校级")
		$x .= ($x=="")? $v->honourname : "，".$v->honourname;
	if($v->jibie == "院级")
		$y .= ($y=="")? $v->honourname : "，".$v->honourname;
		$record=array($x,$y);
		//$data[$v->classid]["dlist"][$v->sid]["hlist"]["x"] = $x;
		//$data[$v->classid]["dlist"][$v->sid]["hlist"]["y"] = $y;
		$data[$v->classid]["dlist"][$v->sid]["hlist"] = $record;
}
}
}else {
	ShowMsg("请选择所属学年/学期","back");
}
}
if($_GET["act"] == "out"){
	header("Content-type: application/vnd.ms-excel; charset=gb2312");
	Header("Content-Disposition: attachment; filename=honour.xls");
	$tnow = "<td>班级</td><td>姓名</td>";
	if($honour=="校级")
	$tnow .= "<td>校级荣誉</td>";
	elseif($honour=="院级")
	$tnow .= "<td>院级荣誉</td>";
	else
	$tnow .= "<td>校级荣誉</td><td>院级荣誉</td>";
	echo "<table border=1><tr>".iconv("utf-8","gb2312",$tnow)."</tr>\n";
if(count($data) > 0){
	$outc="";
	foreach($data as $k=>$v){
		$cnow = count($v["dlist"]);
		$outc .= "<tr><td rowspan='$cnow'>".$v["classname"]."</td>";
		if($cnow > 0){
			foreach($v['dlist'] as $k1=>$v1){
				$outc .= "<td>".$v1['name']."</td>";
						$schhon = $v1['hlist'][0];
						$yuanhon = $v1['hlist'][1];
						if($honour=="校级")
							$outc .= "<td>".$schhon."</td>";
						elseif($honour=="院级")
							$outc .= "<td>".$yuanhon."</td>";
						else
						{
							$outc .= "<td>".$schhon."</td>";
							$outc .= "<td>".$yuanhon."</td>";
						}
				$outc .= "</tr>";
					
			}
		}else{
			$outc .= "<td>暂无数据</td><td>暂无数据</td></tr>";
		}
	}
	echo iconv("utf-8","gb2312",$outc);
}
	echo "</table>";
}else{
$title="学生荣誉";
include("header.php");
?>
<div class="menu tc">
<a href="index.php">返回</a>　　
<a href="data_in.php?name=honour_select">批量导入学生荣誉</a>　　
<a href="scholar.php">普通录入</a>　　
<a href="<?php echo "honour_select.php?act=out&s_major=$s_major&s_year=$s_year&s_class=$s_class&xuenian=$xuenian&xueqi=$xueqi&honour=$honour"; ?>">导出数据</a>　　<br/>
<form  action="honour_select.php" method="get"  class="dis in">
<input type='hidden' name='act' value='stat'>
<?php
	require_once 's_year_class.php';
?>
  所属学年<select name="xuenian"><option value=''>全部</option>
<?php
foreach($yeardata as $v){
	$se = ($v == $xuenian)? " selected " : "";
	echo "<option $se value='$v'>$v</option>";
}
?>
  </select>
　学期<select name='xueqi'><option value=''>全部</option>
	<option <?php if($xueqi == 1){echo "selected";} ?> value="1">第一学期</option>
	<option <?php if($xueqi == 2){echo "selected";} ?> value="2">第二学期</option>
	</select>
　荣誉等级<select name='honour'><option value=''>全部</option>";
		<option <?php if($honour == "校级"){echo "selected"; } ?> value="校级" >校级</option>
		<option <?php if($honour == "院级"){echo "selected";} ?>  value="院级">院级</option>
	</select>
<input type="submit" value="查询"/>　　　　　
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
	<td>班级</td>
	<td>姓名</td>
<?php
if($honour=="校级")
echo "<td>校级荣誉</td>";
elseif($honour=="院级")
echo "<td>院级荣誉</td>";
else
echo "<td>校级荣誉</td><td>院级荣誉</td>";
?>
	<td>操作</td>
</tr>
<?php
if(count($data) > 0){
	foreach($data as $k=>$v){
		$cnow = count($v["dlist"]);
		//echo "<tr><td rowspan='$cnow'>".$v["classname"]."</td>";
		echo "<tr><td rowspan='$cnow'>".$v["classname"]."</td>";
		if($cnow > 0){
			foreach($v['dlist'] as $k1=>$v1){
				echo "<td><a href='stuinfo.php?sid=$k1'>".$v1['name']."</a></td>";
						$schhon = $v1['hlist'][0];
						$yuanhon = $v1['hlist'][1];
						if($honour=="校级")
							echo "<td>".$schhon."</td><td><a href='scholar_del.php?act=honour_delete&sid=$k1&year=$xuenian&xueqi=$xueqi&jibie=$honour&s_major=$s_major&s_class=$s_class' onClick='delete_confirm'>删除</a></td>";
						elseif($honour=="院级")
							echo "<td>".$yuanhon."</td><td><a href='scholar_del.php?act=honour_delete&sid=$k1&year=$xuenian&xueqi=$xueqi&jibie=$honour&s_major=$s_major&s_class=$s_class' onClick='delete_confirm'>删除</a></td>";
						else
						{
							echo "<td>".$schhon."</td>";
							echo "<td>".$yuanhon."</td>";
							echo "<td><a href='scholar_del.php?act=honour_delete&sid=$k1&year=$xuenian&xueqi=$xueqi&jibie=$honour&s_major=$s_major&s_class=$s_class' onClick='delete_confirm'>删除</a></td>";
						}
				echo "</tr>";
					
			}
		}else{
			echo "<td>暂无数据</td><td>暂无数据</td></tr>";
		}
	}
}
?>
</table>
      	<?php include("footer.php");?>
</body>
</html>
<?php
}
?>
