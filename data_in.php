<?php
require_once 'include/common.inc.php';
$action = $_POST['action'];
$name = $_GET['name'];
if($action=='save')
{
	$nowdate = date("Y-m-d H:i:s");
	setlocale(LC_ALL, 'en_US.UTF-8');
	$ems = fopen($_FILES["datafile"]["tmp_name"],"r");
	$i = 0;
	$n = 0;
	$stararr = array(""=>0,"一星"=>1,"二星"=>2,"三星"=>3,"四星"=>4,"五星"=>5);
	$xueqiarr = array(""=>0,"第一学期"=>1,"第二学期"=>2);
	$classpara = globalpara("class",1); 
	while ($data = fgetcsv($ems)){
		if($name == "student"){
			if($i > 0 && count($data) >= 20){
				$s_id = (double)$data[0];
				$pwd=md5($s_id);
				$classid = (double)$data[1];
				$nationid = (int)$data[7];
				$birth = str_replace("年","-",$data[5]);
				$birth = str_replace("月","-",$birth);
				$birth = str_replace("日","",$birth);
				$status = (count($data)>=20)? $data[19] : "";
				$sql = "INSERT INTO `student_info` (`sid`, `pwd`, `classid`, `name`, `sex`, `identity`, `birthday`, `photo`, `nationid`, `native`, `homeaddress`, `zipcode`, `mobilephone`, `dormbn`, `dormnumber`, `fathername`, `fathermobilephone`, `mathername`, `mathermobilephone`, `type`, `status`, `initial`,`first`, `beizhu`, `addtime`, `edittime`) VALUES ($s_id, '$pwd', $classid, '$data[2]', '$data[3]', '$data[4]', '$birth', '$data[6]', $nationid, '$data[8]', '$data[9]', '$data[10]', '$data[11]', '$data[12]', '$data[13]', '$data[14]', '$data[15]', '$data[16]', '$data[17]', '$data[18]', '$status', '$data[20]','$data[21]', '$data[22]', '$nowdate', '$nowdate') ";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "class"){
			if($i > 0 && count($data) >= 7){
				$c_id = (double)$data[0];
				$majorid = (double)$data[2];
				$year = substr($data[0],0,4);
				$sql = "insert into `class` (`id`, `name`, `year`, `majorid`, `classroom`, `capacity`, `deanteacher`, `monitor`, `edittime`) VALUES ($c_id, '$data[1]', '$year', $majorid, '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "xueshenghui"){
			if($i > 0 && count($data) >= 5){
				$sql = "insert into `xueshenghui` (`jieci`, `zhiwu`, `name`, `class`, `phone`, `edittime`) VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "stu_type"){
			if($i > 0 && count($data) >= 2){
				$t_id = (double)$data[0];
				$sql = "insert into `student_type` (`id`, `name`) VALUES ($t_id, '$data[1]')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "nation"){
			if($i > 0 && count($data) >= 2){
				$n_id = (double)$data[0];
				$sql = "insert into `nation` (`id`, `name`) VALUES ($n_id, '$data[1]')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "major"){
			if($i > 0 && count($data) >= 2){
				$m_id = (double)$data[0];
				$sql = "insert into `major` (`id`, `name`) VALUES ($m_id, '$data[1]')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "cteacher"){
			if($i > 0 && count($data) >= 13){
				$t_id = (double)$data[2];
				$sql = "insert into `cteacher` (`id`,`name`,`tid`,`sex`,`birthday`,`zhengzhi`,`xueli`,`zhicheng`,`worktime`,`bumen`,`zhiwu`,`zhuanjian`,`mobile`,`addtime`) VALUES (NULL,'$data[1]','$t_id', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]', '$data[8]', '$data[9]', '$data[10]', '$data[11]', '$data[12]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "activity_join"){
			if($i > 0 && count($data) >= 7){
				$sid=(double)$data[2];
				$xueqi=(double)$data[4];
				$sql = "insert into `activity_join` (`id`,`class`,`name`,`sid`,`year`,`xueqi`,`content`,`time`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$sid', '$data[3]', '$xueqi','$data[5]','$data[6]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "cjiti_prize"){
			if($i > 0 && count($data) >= 7){
				$xueqi=(double)$data[2];	
				$sql = "insert into `cjiti_prize` (`id`,`class`,`prizeyear`,`xueqi`,`prizedate`,`prizelevel`,`prizename`,`prizegrade`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$xueqi', '$data[3]', '$data[4]','$data[5]','$data[6]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "dormzhian"){
			if($i > 0 && count($data) >= 9){
				$xueqi=(double)$data[2];	
				$zhouci=(double)$data[3];
				$sql = "insert into `dormzhian` (`id`,`class`,`year`,`xueqi`,`zhouci`,`time`,`name`,`weiji`,`jibie`,`recorder`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$xueqi', '$zhouci', '$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "eng_statistic"){
			if($i > 0 && count($data) >= 13){
				$sid=(double)$data[2];	
				$sql = "insert into `eng_statistic` (`id`,`class`,`name`,`sid`,`engthirda`,`engthirdb`,`engforth`,`engsixth`,`computerfirst`,`certione`,`certitwo`,`certithree`,`certifour`,`beizhu`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$sid', '$data[3]', '$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "keji_invent"){
			if($i > 0 && count($data) >= 8){
				$xueqi=(double)$data[4];	
				$sql = "insert into `keji_invent` (`id`,`class`,`name`,`sid`,`year`,`xueqi`,`content`,`time`,`unit`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$data[2]', '$data[3]', '$xueqi','$data[5]','$data[6]','$data[7]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "publish_articles"){
			if($i > 0 && count($data) >= 10){
				$sid=(double)$data[2];
				$xueqi=(double)$data[4];	
				$gaochou=(double)$data[9];
				$sql = "insert into `publish_ articles` (`id`,`class`,`name`,`sid`,`year`,`xueqi`,`articlename`,`publishdate`,`kanwuname`,`kanwujibie`,`gaochou`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$sid', '$data[3]', '$xueqi','$data[5]','$data[6]','$data[7]','$data[8]','$gaochou','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "scholarship"){
			if($i > 0 && count($data) >= 8){
				$xueqi=(double)$data[2];	
				$sid=(double)$data[4];
				$sql = "insert into `scholarship` (`id`,`xueyuan`,`year`,`xueqi`,`class`,`sid`,`name`,`scholarship`,`beizhu`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$xueqi', '$data[3]', '$sid','$data[5]','$data[6]','$data[7]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "social_practice"){
			if($i > 0 && count($data) >= 7){		
				$sid=(double)$data[2];
				$xueqi=(double)$data[4];
				$sql = "insert into `social_practice` (`id`,`class`,`name`,`sid`,`year`,`xueqi`,`grade`,`personalgrade`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$sid', '$data[3]', '$xueqi','$data[5]','$data[6]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "bisai_prize"){
			if($i > 0 && count($data) >= 9){		
				$sid=(double)$data[2];
				$prizexueqi=(double)$data[4];
				$sql = "insert into `sbisai_prize` (`id`,`class`,`name`,`sid`,`prizeyear`,`prizexueqi`,`prizedate`,`level`,`prizename`,`prizegrade`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$sid', '$data[3]', '$prizexueqi','$data[5]','$data[6]','$data[7]','$data[8]','$nowdate')";
				$result = ($sid)? $yiqi_db->query($sql) : 0 ;
				if($result == 1)
					$n++;
			}
		}else if($name == "stuhonour"){
			if($i > 0 && count($data) >= 6){		
				$xueqi=(double)$data[1];
				$sql = "insert into `stuhonour` (`id`,`year`,`xueqi`,`class`,`name`,`honourname`,`jibie`,`addtime`) VALUES (NULL,'$data[0]','$xueqi', '$data[2]', '$data[3]', '$data[4]','$data[5]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "vol_service"){
			if($i > 0 && count($data) >= 8){		
				$sid=(double)$data[2];
				$xueqi=(double)$data[4];
				$sql = "insert into `vol_ service` (`id`,`class`,`name`,`sid`,`year`,`xueqi`,`content`,`time`,`grade`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$sid', '$data[3]', '$xueqi','$data[5]','$data[6]','$data[7]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "wanzixi_class"){
			if($i > 0 && count($data) >= 6){		
				$xueqi=(double)$data[2];
				$zhouci=(double)$data[3];
				$score=(double)$data[4];
				$sql = "insert into `wanzixi_class` (`id`,`class`,`year`,`xueqi`,`zhouci`,`score`,`recorder`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$xueqi', '$zhouci', '$score','$data[5]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "wanzixi_personal"){
			if($i > 0 && count($data) >= 11){		
				$xueqi=(double)$data[3];
				$kuangkezhouci=(double)$data[4];
				$chidaozhouci=(double)$data[6];
				$zaotuizhouci=(double)$data[8];
				$sql = "insert into `wanzixi_personal` (`id`,`class`,`name`,`year`,`xueqi`,`kuangkezhouci`,`kuangkedate`,`chidaozhouci`,`chidaodate`,`zaotuizhouci`,`zaotuidate`,`recorder`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$data[2]', '$xueqi', '$kuangkezhouci','$data[5]','$chidaozhouci','$data[7]','$zaotuizhouci','$data[9]','$data[10]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "weisheng_sch"){
			if($i > 0 && count($data) >= 9){		
				$xueqi=(double)$data[2];
				$zhouci=(double)$data[3];
				$sql = "insert into `weisheng_sch` (`id`,`class`,`year`,`xueqi`,`zhouci`,`dormlou`,`dormnum`,`score`,`checkdate`,`recorder`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$xueqi', '$zhouci', '$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "weisheng_yuanji"){
			if($i > 0 && count($data) >= 9){		
				$xueqi=(double)$data[2];
				$zhouci=(double)$data[3];
				$score=(double)$data[6];
				$sql = "insert into `weisheng_yuanji` (`id`,`class`,`year`,`xueqi`,`zhouci`,`dormlou`,`dormnum`,`score`,`checkdate`,`recorder`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$xueqi', '$zhouci', '$data[4]','$data[5]','$score','$data[7]','$data[8]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "zaocao_class"){
			if($i > 0 && count($data) >= 6){		
				$xueqi=(double)$data[2];
				$zhouci=(double)$data[3];
				$score=(double)$data[4];
				$sql = "insert into `zaocao_class` (`id`,`class`,`year`,`xueqi`,`zhouci`,`score`,`recorder`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$xueqi', '$zhouci', '$score','$data[5]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "zaocao_personal"){
			if($i > 0 && count($data) >= 11){		
				$xueqi=(double)$data[3];
				$kuangcaozhouci=(double)$data[4];
				$chidaozhouci=(double)$data[6];
				$sql = "insert into `zaocao_personal` (`id`,`classname`,`name`,`year`,`xueqi`,`kuangcaozhouci`,`kuangcaodate`,`chidaozhouci`,`chidaodate`,`burenzhenzhouci`,`burenzhendate`,`recorder`,`addtime`) VALUES (NULL,'$data[0]','$data[1]','$data[2]', '$xueqi', '$kuangcaozhouci','$data[5]','$chidaozhouci','$data[7]','$data[8]','$data[9]','$data[10]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "zige_certificate"){
			if($i > 0 && count($data) >= 12){
				$sid=(double)$data[2];	
				$sql = "insert into `zige_certificate` (`id`,`class`,`name`,`sid`,`engthirda`,`engthirdb`,`engforth`,`engsixth`,`computerfirst`,`certione`,`certitwo`,`certithree`,`certifour`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$sid', '$data[3]', '$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "xuefeng"){
			if($i > 0 && count($data) >= 6){		
				$xueqi=(double)$data[2];
				$sql = "insert into `xuefeng` (`id`,`class`,`year`,`xueqi`,`scholarrate`,`bujige`,`bukao`,`addtime`) VALUES (NULL,'$data[0]','$data[1]', '$xueqi', '$data[3]', '$data[4]','$data[5]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "absent"){
			if($i > 0 && count($data) >= 9){		
				$sql = "insert into `stu_absent_record` (`id`,`classname`,`name`,`year`,`xueqi`,`zhouci`,`keshi`,`coursename`,`absentriqi`,`record`,`addtime`) VALUES (NULL,'$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "user"){
			$pwd = md5($data[0]);
			if($i > 0 && count($data) >= 2){		
				$sql = "insert into `user` (`sid`,`password`,`edittime`) VALUES ($data[0],'$pwd','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "chufen"){
			if($i > 0 && count($data) >= 7){		
				$sql = "insert into `stu_chufen` (`id`,`sid`,`classname`,`name`,`type`,`reason`,`wenjianhao`,`chufendata`,`edittime`) VALUES (NULL,'$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}else if($name == "sushe_star"){
			if($i > 0 && count($data) >= 8){
				$classnow = (is_numeric($data[0]))? $data[0] : $classpara[$data[0]];
				$star = (is_numeric($data[6]))? $data[6] : $stararr[$data[6]];
				$dormlou = (is_numeric($data[1]))? "学".$data[1] : $data[1];
				$xueqi = (is_numeric($data[4]))? $data[4] : $xueqiarr[$data[4]];
				$sql = "insert into `sushe_star` (`id`,`class`,`year`,`xueqi`,`month`,`dormlou`,`dormnum`,`score`,`recorder`,`addtime`) VALUES (NULL,'$classnow','$data[3]','$xueqi','$data[5]','$dormlou','$data[2]','$star','$data[7]','$nowdate')";
				$result = $yiqi_db->query($sql);
				if($result == 1)
					$n++;
			}
		}
		
		$i++;
	}
		ShowMsg("操作成功！本次操作共导入 ".($i - 1)." 条数据，其中成功 $n 条，失败 ".($i-1-$n)." 条。","back");
		//echo "操作成功！本次操作共导入 ".($i - 1)." 条数据，其中成功 $n 条，失败 ".($i-1-$n)." 条。";
}
$title="批量导入数据";
include("header.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script type="text/javascript">
$(document).ready(function(){
	$("#data").submit(function(){
		if($("input[name='datafile']").val() == "")
		{
			alert("请选择导入数据文件。");
			return false;
		}else
		{
			return true;
		}
	});
});
</script>
</head>

<form id="data" action="" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="action" value="save" />
<table border=0 cellpadding=0 cellspacing=0 class="t_list list5">
	<tr><th>批量导入数据</th><th><a href="<?php echo $name; ?>.php">返回列表</a></th></tr>
	<tr>
		<td width="100">选择文件</td>
		<td><input type="file" name="datafile" />　　<span>友情提示：导入文件类型为csv格式，编码为utf-8。</span></td>
	</tr>
	<tr>
		<td></td><td><input type="submit" value=" 提 交 " /></td>
	</tr>
</table>
</form>
</div>
</div>
      	<?php include("footer.php");?>

</body>
</html>
