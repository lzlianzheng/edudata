<?php
	require_once 'include/common.inc.php';
	include("header.php");
	
	$now = date("Y-m-d H:i:s");
	$sql="select * from nation";

	$nation=$yiqi_db->get_results($sql);
	$type=$yiqi_db->get_results("select * from student_type");
	
	$action = $_REQUEST['act'];
	$sid= $_POST['sid'];
	$name=$_POST['name'];
	$cid=$_POST['class'];
	$identity=$_POST['identity'];
	$sex=$_POST['sex'];
	$minzu=$_POST['minzu'];
	$birthday=$_POST['birthday'];
	$mobilephone=$_POST['mobilephone'];
	$dormbn=$_POST['dormbn'];
	$dormnumber=$_POST['dormnumber'];
	$stutype=$_POST['stutype'];
	$status=$_POST['status'];
	$zipcode=$_POST['zipcode'];
	$fathername=$_POST['fathername'];
	$fathermobilephone=$_POST['fathermobilephone'];
	$mathername=$_POST['mathername'];
	$mathermobilephone=$_POST['mathermobilephone'];
	$native=$_POST['native'];
	$homeaddress=$_POST['homeaddress'];
	$initial=$_POST['s_class'];
	$first=$_POST['s_major'];
	$beizhu = $_POST['beizhu'];
	$pwd=md5($sid);
	if($action=='ins')
	{
	$in="insert into student_info (sid,pwd,classid,name,sex,identity,birthday,photo,nationid,native,homeaddress,zipcode,mobilephone,
	dormbn,dormnumber,fathername,fathermobilephone,mathername,mathermobilephone,type,status,initial,first,beizhu,addtime,edittime)
	value($sid,'$pwd',$cid,'$name','$sex','$identity','$birthday','',$minzu,'$native','$homeaddress','$zipcode','$mobilephone','$dormbn','$dormnumber','$fathername','$fathermobilephone','$mathername','$mathermobilephone','$stutype','$status','$initial','$first','$beizhu','$now','$now')";
	$a=$yiqi_db->query($in);
	if($a)
	{
	echo "<script type=text/javascript>alert('添加成功');location.href='stu_insert.php';</script>";exit;
	}else
	{
	echo "<script type=text/javascript>alert('添加失败，请检查填写信息是否有误');window.history.go(-1);</script>";exit;
	}
	}
$title="学生信息录入";	
?>

<div class="menu tc">
<h2 class="disin">添加学生基本信息</h2>
<br><a href="student.php">返回   </a>
</div>
<form action="stu_insert.php" method="post">
<input type="hidden" name="act" value="ins">
<table  cellspacing="0" cellpadding="0" class="t_list list5">
		<tr>
		<td>学号</td><td><input type="text" name="sid" value="" /></td>
		<td>姓名</td><td><input type="text" name="name" value="" /></td>
		</tr>
		<tr>
		<td>班级</td>
		<td>
		<select name="class">
		<option value="">请选择</option>
		<?php 
		$major_sql = "select * from major where uid = $uid ";
		$majorpara=$yiqi_db->get_results($major_sql);
		$cpara_sql = "select * from class where 1";
		$cpara_sql .= " order by name";
		$classdata=$yiqi_db->get_results($cpara_sql);
		//$classpara=globalpara("class");
		foreach($classdata as $v)
		{
			//$classpara[$v->id] = $v->name;
			foreach($majorpara as $j)
			{
				if($v->majorid == $j->id )
				{
					$ckif = ($v->id == $s_class)? "selected" : "" ;
					echo "<option $ckif value='$v->id'>$v->name</option>";
				}
			}
		}
		?>
		</select>
		</td>
		<td>身份证号</td><td><input type="text" name="identity" value="" /></td>
		</tr>
		<tr>
		<td>性别</td>
		<td>
		<select name="sex">
		<option value="男">男</option>
		<option value="女">女</option>
		</select>
		</td>
		<td>民族</td>
		<td>
		<select name="minzu">
		<?php 
		foreach($nation as $k=>$v)
		{
			echo "<option value='$v->id'>$v->name</option>";
		}
		?>
		</select>
		</td>
		</tr>
		<tr>
		<td>生日</td><td><input type="text" name="birthday" value=""/></td>
		<td>学生手机</td><td><input type="text" name="mobilephone" value=""/></td>
		</tr>
		<tr><td>宿舍楼</td><td><input type="text" name="dormbn" style="width:40px" value="" /></td>
		<td>宿舍号</td>
		<td><input type="text" name="dormnumber" style="width:105px" value=""/></td>
		</tr>
		<tr>
		<td>学生类型</td>
		<td>
		<select name="stutype">
		<option value="">请选择</option>
		<?php 
		foreach($type as $k=>$v)
		{
			echo "<option value='$v->id'>$v->name</option>";
		}
		?>
		</select>
		</td>
		<td>状态</td><td><input type="text" name="status"></td>
		</tr>
		<tr><td>父亲姓名:</td><td><input type="text" name="fathername" value=""/></td><td>父亲电话:</td><td><input type="text" name="fathermobilephone" value=""/></td></tr>
<tr><td>母亲姓名:</td><td><input type="text" name="mathername" value=""/></td><td>母亲电话:</td><td><input type="text" name="mathermobilephone" value=""/></td></tr>
<tr><td>籍贯</td><td><input type="text" name="native"></td><td>邮编:</td><td><input type="text" name="zipcode" value=""/></td></tr>
<tr><td>家庭地址:</td><td><textarea name="homeaddress" rows="5" cols="35"></textarea></td><td>备注</td><td><textarea name="beizhu" rows="5" cols="35"></textarea></td></tr>
<tr><td colspan=4 align=center><input type="submit" value="  提  交  " /></td></tr>
</table>
</form>
      	<?php include("footer.php");?>
</body>
</html>
