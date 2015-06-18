<?php
require_once 'include/common.inc.php';
header("Content-Type:text/html;charset=utf-8");
$curpage = $_GET["p"];
$curpage = (isset($curpage) && is_numeric($curpage)) ? $curpage : 1;
if($curpage<1)
	$curpage=1;
//$sql1="select distinct(a.type)  from student_info a left join class b on a.classid=b.id";
//$sql = "select a.*,b.mobile as m1,c.mobilephone as m2 from class a left join cteacher b on a.deanteacher=b.name left join student_info c on //a.monitor=c.name and a.id=c.classid";
//$orderby = " order by edittime desc ";	
//$orderby = "";	
if($_REQUEST['act']=='sel')
{
$syear = $_GET["syear"];
$eyear = $_GET["eyear"];

//switch($types)
//{
// case 0:
//  $type="普招生";
//  break;
// case 1:
//  $type="插班生";
//  break;
// case 2:
//  $type="原插班生参加自主招生获得学籍学生";
//  break;
// case 3:
//  $type="非在读学生";
//  break;
// case 4:
//  $type="少数民族学生";
//  break;
// case 5:
//  $type="休学";
//  break;
// case 6:
//  $type="参军";
//  break;
// case 7:
//  $type="专转本";
//  break;
// case 8:
//  $type="专接本";
//  break;
// default:
//  break;
//}
}
if($_REQUEST['act2']=='sel2')
{
 $searchcriteria=$_GET["jiguan"];
}
$sql = "select a.sid as res2,a.name as res3,a.mobilephone as res4,b.name as res1 from student_info a , class b where a.classid=b.id ";
$sql2 = "select id from class  where 1";
$sql2 .=($syear)?" and year>='$syear' ":"";
$sql2 .=($eyear)? " and year<='$eyear' " : "";

if($syear || $eyear)
	$sql .= " where a.classid in ($sql2) ";
if($searchcriteria)
 $sql .="and native like '%$searchcriteria%'";

$result=$yiqi_db->get_results($sql);

if($_REQUEST['act2']=='sel2')
 $resultcount = $yiqi_db->get_row("select count(a.sid) as c from student_info a where native like '%$searchcriteria%'");
else
 $resultcount = $yiqi_db->get_row("select count(a.sid) as c from student_info a where a.classid in($sql2)");
$total = (int)$resultcount->c;
$take = 50;
$totalpage = (int)($total % $take == 0 ? $total / $take : $total / $take + 1);
$curpage = ($totalpage == 0)? 1 : (($curpage > $totalpage)? $totalpage : $curpage) ;
$skip = ($curpage - 1) * $take;
$result = $yiqi_db->get_results($sql . " limit $skip,$take ");
$majorpara = globalpara("major");
if($_REQUEST['act']=='sel')
 $url = "fenleidatachaxun.php?act=sel&syear=$syear&eyear=$eyear&";
else if($_REQUEST['act2']=='sel2')
 $url = "fenleidatachaxun.php?act2=sel2&jiguan=$searchcriteria&";
else
 $url="fenleidatachaxun.php?";
$pagerhtml = pager($totalpage,$curpage,$url);

if($_REQUEST['act']=='delete')
{
//$cid = $_GET["cid"];
$sid=$_GET["sid"];
$syear = $_GET["syear"];
$eyear = $_GET["eyear"];

$sql="delete from student_info sid=$sid";
$result=$yiqi_db->query($sql);

if($result==1)
		ShowMsg("删除成功","class.php?act=sel&syear=$syear&eyear=$eyear");
else
		ShowMsg("操作失败","back");
}
$title="分类数据查询";
include("header.php");
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#pagego_do").click(function(){
		v = parseInt($("#pagego").val()); 
		if(v > <?php echo $totalpage; ?> || isNaN(v))
		{
			alert("请输入正确的页码。");
		}else
		{ 
			window.location.href="<?php echo $url; ?>p=" + v;
		}
	});
});
</script>
<div class="menu">
<a href="data_in.php?name=fenleidatachaxun">导入数据</a>　
<a href="class_insert.php">普通录入</a>　　
<a href="data_out.php?name=fenleidatachaxun">导出数据</a>
<p style="color:#999999">您可以根据需要的数据类别，直接点击该按钮查询，在这之前您需要选择对应的年级。</p>
<form action="fenleidatachaxun.php" method="get" class="disin">
<input type="hidden" name="act" value="sel">
		   请选择入学年起止：起 
	 <select name='syear'>
		<option value="">全部</option>;
		<?php
		  $sql_temp="select distinct(year) from class order by year desc limit 0,3";
		  $classpara1=$yiqi_db->get_results($sql_temp);
		  
		  foreach($classpara1 as $k=>$x){
			$se = ($x->year==$syear)? " selected " : "";
			echo "<option $se value='$x->year'>$x->year</option>";
		  }
		?>
		</select>
　止
 <select name="eyear">
 	<option value="">全部</option>
 	<?php
 	 foreach($classpara1 as $k=>$x)
 	    {
 	     $se=($x->year==$eyear)? "selected":"";
 	     echo "<option $se value='$x->year'>$x->year</option>";
 	    }
 	?>
 </select>
 <input style="margin-left:10px" type="submit" value="查询" id="submit" />
<br/>
  <div class="but_sel" >
  <!--请选择数据类别：		   
  <select name="searchcriteria" >
 	<option value="">全部</option>
 	<option value="1">插班生</option>
 	<option value="2">原插班生参加自主招生获得学籍学生</option>
 	<option value="3">非在读学生</option>
 	<option value="4">少数民族学生</option>
	<option value="5">休学</option>
	<option value="6">参军</option>
	<option value="7">专转本</option>
	<option value="8">专接本</option>

 </select>
 </div>
	<input style="margin-left:10px" type="submit" value="查询" id="submit1" /-->
</form>

<form action="fenleidatachaxun.php" method="get">
 <input type="hidden" name="act2" value="sel2"/>
  按籍贯查询，请输入籍贯关键词：<input type="text" name="jiguan" />
<input style="margin-left:10px" type="submit" value="查询" id="submit" />
</form>
</div>
<table cellspacing="0" cellpadding="0" class="t_list tc list5">
<tr>
  	<td>序号</td>
	<td>班级</td>
	<td>学号</td>
	<td>姓名</td>
	<td>查询条件</td>
	<td>电话</td>
	<td>操作</td>
</tr>
<?php
 	$temp=" group by res2 order by res2 limit $skip,$take";
 	$sql_sel="select a.sid as res2,a.name as res3,a.mobilephone as res4,b.name as res1 from student_info a , class b where a.classid=b.id ";
 
 	if($syear&&$eyear)
 	{
 	 $sql_sel.="and b.year>=$syear and b.year<=$eyear".$temp;
 	}else if($syear)
 	{
 	 $sql_sel.="and b.year>=$syear".$temp;
 	}else if($eyear)
 	{
 	 $sql_sel.="and b.year<=$eyear".$temp;
 	}else if($searchcriteria)
	{
 	 $sql_sel.="and native like '%$searchcriteria%'".$temp;
	}
 	 else
 	 {
 	  $sql_sel.=$temp;
 	 }
 	 $resul=$yiqi_db->get_results($sql_sel);
if(count($resul) > 0){
 	$xh=1;
	foreach($resul as $v){
		$banji=$v->res1;
		$xuehao=$v->res2;
		$xingming=$v->res3;
		$dianhua=$v->res4;
		echo "<tr>
		 	<td>$xh</td>
			<td>$banji</td>
			<td>$xuehao</td>
			<td><a href='stuinfo.php?sid=$v->res2'>$xingming</a></td>
			<td>$searchcriteria</td>
			<td>$dianhua</td>
			<td><a href='fenleidatachaxun.php?act=delete&sid=$v->res2&syear=$syear&eyear=$eyear' onClick='delete_confirm' >删除</a></td>
		</tr>";
		$xh++;
	}
}
?>
</table>
 <center>
<?php
 if($totalpage > 1)
 {	
	echo '<div class="pager">总计 '.$total.' 条记录，每页 '.$take.' 条，共 '.$totalpage.' 页。　　　　　到第<input type="text" id="pagego" />页 <input type="button" value=" GO " id="pagego_do" />　'.$pagerhtml.'</div>';
 }
?>
</center>

      	<?php include("footer.php");?>
</body>
</html>
