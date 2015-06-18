<?php
require_once 'include/common.inc.php';
$sql1="select distinct(year) from class order by year desc limit 0,3";
$yeardata=$yiqi_db->get_results($sql1);

for($k=0;$k<3;$k++)
{
  if($k==0)
   $year_end=$yeardata[$k];
 else if($k==1)
   $year_middle=$yeardata[$k];
 else if($k==2)
   $year_start=$yeardata[$k];
}
$sql2="SELECT * FROM `major`";
$zhuanyedata=$yiqi_db->get_results($sql2);

$firstupload_flag="yes";
if($_REQUEST['act']=='sel')
{
 $syear=$_GET["syear"];
 $eyear=$_GET["eyear"];
 $firstupload_flag="no";
 
  if($syear<=$eyear&&$syear!="")
  {
   $year_flag="yes";
  }
}

if($_REQUEST['act']=='zysel')
{
 $zhuanye=$_GET["zhuanye"];
 $firstupload_flag="no";
 if($zhuanye)
 $zy_flag="yes";
 
 $sql4="select id from major WHERE name='$zhuanye'";
 $majoridzy=$yiqi_db->get_results($sql4);
 $zymajorid=$majoridzy[0]->id;
 
}

 $title="基础数据统计";
 include("header.php");

 ?>
 
 
<div class="menu">
		   当前页面默认数据是目前在校数据统计，如果你想要查询特定年级，请选择<br/>
<form action="jichu_datastatistics.php" method="get" class="disin">
	<input type="hidden" value="sel" name="act">
		   请选择入学年：起
		   <select name="syear">
		     <option value=""></option>
		     <?php
		       foreach($yeardata as $k_year=>$v_syear)
		      {
		       if($v_syear->year)
		       {
		        if($v_syear->year==$syear)
		         echo "<option value='$v_syear->year' selected>$v_syear->year</option>";
		        else
		         echo "<option value='$v_syear->year'>$v_syear->year</option>";
		       }
		      }
		     ?>
		   </select>
		      &nbsp;&nbsp;止&nbsp;
		   <select name="eyear">
		    <option value=""></option>
		    <?php
		     foreach($yeardata as $k_year=>$v_eyear)
		     {
		      if($v_eyear->year)
		      {
		       if($v_eyear->year==$eyear)
		        echo "<option value='$v_eyear->year' selected>$v_eyear->year</option>";
		       else
		        echo "<option value='$v_eyear->year'>$v_eyear->year</option>";
		      }
		     }
		    ?>
		   </select>
		    
		   <input style="margin-left:10px" type="submit" value="查询" id="submit">
		   <br/>
</form>
<form action="" method="get" class="disin">
		<input type="hidden" value="zysel" name="act">
		   请选择专业：
		   <select name="zhuanye" id="zhuanye">
		    <option value="">请选择</option>
		    <?php
		     foreach($zhuanyedata as $k=>$v)
		     {
		      if($v->name)
		      {
		       if($v->name==$zhuanye)
		        echo "<option value='$v->name' selected>$v->name</option>";
		       else
		        echo "<option value='$v->name'>$v->name</option>";
		      }
		     }
		    ?>
		   </select>
		   <input style="margin-left:20px" type="submit" value="查询">
</from>
</div>
			<table cellspacing="0" cellpadding="0" class="t_list tc list5">
			<tr>
			  <td>目前在校年级</td>
			  <td colspan="3"><?php 
			 if($year_flag=="yes"){
			    for($i=$syear;$i<=$eyear;$i++)
			    {
			     echo $i."&nbsp;&nbsp;";
			    }
			}else if($firstupload_flag=="yes")
			{
			  for($k=0;$k<3;$k++)
			    {
			     $now_class=$yeardata[$k];
			     echo $now_class->year."&nbsp;&nbsp;";
			    }
			}else if($zy_flag=="yes")
			 {
			  $sql5="select distinct(year) from class WHERE majorid='$zymajorid' order by year asc";
			  $now_class=$yiqi_db->get_results($sql5);
			  foreach($now_class as $k=>$v)
			  {
			   echo $v->year."&nbsp;&nbsp;";
			  }
			 }
			    ?>
			  </td>
			</tr>
			<tr>
			  <td>目前在校总人数</td>
			  <td><?php 
			     if($year_flag=="yes")
			    {
			     $class_id="SELECT id FROM `class` WHERE year>='$syear' and year<='$eyear' ";
			     $total_stu_number=$yiqi_db->get_row("select count(sid) as total from student_info where classid in ($class_id)");
			     $chaban = $yiqi_db->get_row("select count(sid) as c from student_info where type='插班生' and classid in ($class_id)");
			     echo $total_stu_number->total." 人";
			    }else if($firstupload_flag=="yes")
			   {
			     $class_id="SELECT id FROM `class` WHERE year>='$year_start->year' and year<='$year_end->year' ";
			     $total_stu_number=$yiqi_db->get_row("select count(sid) as total from student_info where classid in ($class_id)");
			     $chaban = $yiqi_db->get_row("select count(sid) as c from student_info where type='插班生' and classid in ($class_id)");
			     echo $total_stu_number->total." 人";
			   }else if($zy_flag=="yes")
			    {
			     $class_id="SELECT id FROM `class` WHERE majorid='$zymajorid' ";
			     $total_stu_number=$yiqi_db->get_row("select count(sid) as total from student_info where classid in ($class_id)");
			     $chaban = $yiqi_db->get_row("select count(sid) as c from student_info where type='插班生' and classid in ($class_id)");
			     echo $total_stu_number->total." 人";
			    }
			   ?>
			   </td>
			   <td>插班生人数</td>
			   <td><?php echo $chaban->c." 人";?></td>
			</tr>
			<tr>
			  <td>各年级人数</td>
			  <td colspan="3">
			  	  <?php
			  	 if($firstupload_flag=="yes")
			  	 {
			  	    for($i=$year_start->year;$i<=$year_end->year;$i++)
   					{
    				  $bandatasql="SELECT count(id) as t FROM class WHERE year=$i";
    				  $renshusql="SELECT count(sid) as t FROM `student_info` WHERE classid in (SELECT id FROM `class` WHERE year='$i')";
    				  $banjitotal=$yiqi_db->get_row($bandatasql);
    				  $renshutotal=$yiqi_db->get_row($renshusql);
    				  echo $i."级&nbsp;&nbsp;共".$banjitotal->t."个班&nbsp;&nbsp;共".$renshutotal->t."人<br/>";
    				  $ban_total_new+=$banjitotal->t;
 					}
 					if($syear<=$eyear)
 					echo "共计".$ban_total_new."个班级<br/>";
 				 }else if($year_flag=="yes")
			  	 {
			  	    for($i=$syear;$i<=$eyear;$i++)
   					{
    				  $bandatasql="SELECT count(id) as t FROM class WHERE year=$i";
    				  $renshusql="SELECT count(sid) as t FROM `student_info` WHERE classid in (SELECT id FROM `class` WHERE year='$i')";
    				  $banjitotal=$yiqi_db->get_row($bandatasql);
    				  $renshutotal=$yiqi_db->get_row($renshusql);
    				  echo $i."级&nbsp;&nbsp;共".$banjitotal->t."个班&nbsp;&nbsp;共".$renshutotal->t."人<br/>";
    				  $ban_total_new+=$banjitotal->t;
 					}
 					if($syear<=$eyear)
 					echo "共计".$ban_total_new."个班级<br/>";
 				 }else if($zy_flag=="yes")
 				  {
 				   foreach($now_class as $k=>$v)
 				  {
 				    $bandatasql="SELECT count(id) as t FROM class WHERE year='$v->year' and majorid='$zymajorid'";
    				$renshusql="SELECT count(sid) as t FROM `student_info` WHERE classid in (SELECT id FROM `class` WHERE year='$v->year' and majorid='$zymajorid')";
    				$banjitotal=$yiqi_db->get_row($bandatasql);
    				$renshutotal=$yiqi_db->get_row($renshusql);
    				echo $v->year."级&nbsp;&nbsp;共".$banjitotal->t."个班&nbsp;&nbsp;共".$renshutotal->t."人<br/>";
    				$ban_total_new+=$banjitotal->t;
 				   }
 				   echo "共计".$ban_total_new."个班级<br/>";
 				  }
			  	  ?>
			  </td>
			</tr>
			<tr>
			  <td>各专业人数</td>
			  <td colspan="3">
			  	<?php
			  if($firstupload_flag=="yes")
			  {
  			  	foreach($zhuanyedata as $v)
			  	   {
			  	     $sql3="select count(sid) as t from student_info where classid in (SELECT id FROM class WHERE year>=$year_start->year and year<=$year_end->year and majorid='$v->id') ";
			  	     $result_test=$yiqi_db->get_row($sql3);
			  	     echo $v->name."&nbsp;&nbsp;共".$result_test->t."人<br/>";
			  	   }
			  }else if($year_flag=="yes")
			  {
			   foreach($zhuanyedata as $v)
   					{
   					  $stuidsql="SELECT id FROM class WHERE year>=$syear and year<=$eyear and majorid='$v->id'";
   					  $sql3="select count(sid) as t from student_info where classid in ($stuidsql)";
    				  $result_test=$yiqi_db->get_row($sql3);
			  	      echo $v->name."&nbsp;&nbsp;共".$result_test->t."人<br/>";
 					}
			  }else if($zy_flag=="yes")
			   {
			    $stuidsql="SELECT id FROM class WHERE majorid='$zymajorid'";
   				$sql3="select count(sid) as t from student_info where classid in ($stuidsql)";
    			$result_test=$yiqi_db->get_row($sql3);
			  	echo $zhuanye."&nbsp;&nbsp;共".$result_test->t."人<br/>";
			   }
			   
			  	 ?>
			  </td>
			</tr>
			<tr>
			  <td>班主任人数</td>
			  <td colspan="3">
			  	<?php
			  	
			  	 if($firstupload_flag=="yes")
			  	 {
			  	    for($i=$year_start->year;$i<=$year_end->year;$i++)
   					{
    				  $bandatasql="SELECT count(id) as t FROM class WHERE year=$i";
    				  $renshusql="SELECT count(distinct(deanteacher)) as t FROM `class` WHERE year='$i'";
    				  $banjitotal=$yiqi_db->get_row($bandatasql);
    				  $renshutotal=$yiqi_db->get_row($renshusql);
    				  echo $i."级&nbsp;&nbsp;班主任&nbsp;&nbsp;共".$renshutotal->t."人<br/>";
    				  $ban_total_new1+=$renshutotal->t;
 					}
 					if($syear<=$eyear)
 					echo "共计".$ban_total_new1."人<br/>";
 				 }else if($year_flag=="yes")
			  	 {
			  	    for($i=$syear;$i<=$eyear;$i++)
   					{
    				  $bandatasql="SELECT count(id) as t FROM class WHERE year=$i";
    				  $renshusql="SELECT count(distinct(deanteacher)) as t FROM `class` WHERE year='$i'";
    				  $banjitotal=$yiqi_db->get_row($bandatasql);
    				  $renshutotal=$yiqi_db->get_row($renshusql);
    				  echo $i."级&nbsp;&nbsp;班主任&nbsp;&nbsp;共".$renshutotal->t."人<br/>";
    				  $ban_total_new1+=$renshutotal->t;
 					}
 					if($syear<=$eyear)
 					echo "共计".$ban_total_new1."人<br/>";
 				 }else if($zy_flag=="yes")
 				 {
 				  foreach($now_class as $k=>$v)
 				  {
 				   $bandatasql="SELECT count(id) as t FROM class WHERE year=$v->year and majorid='$zymajorid'";
 				   $renshusql="SELECT count(distinct(deanteacher)) as t FROM `class` WHERE year='$v->year' and majorid='$zymajorid'";
 				   $banjitotal=$yiqi_db->get_row($bandatasql);
 				   $renshutotal=$yiqi_db->get_row($renshusql);
 				   echo $v->year."级&nbsp;&nbsp;班主任&nbsp;&nbsp;共".$renshutotal->t."人<br/>";
 				   $ban_total_new1+=$renshutotal->t;
 				  }
 				  echo "共计".$ban_total_new1."人<br/>";
 				 }
			  	?>
			  </td>
			</tr>
			</table>

      	<?php include("footer.php");?>
</body>
</html>
