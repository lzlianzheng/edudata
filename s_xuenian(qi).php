<?php
require_once 'include/common.inc.php';
	$xuenian=$_GET["xuenian"];
	$xueqi=$_GET["xueqi"];
?>		
	所属学年<select name='xuenian'><option value=''>请选择</option>
<?php
	foreach($yeardata as $v){
		$se = ($v == "$xuenian")? " selected " : "";
		echo "<option $se value=$v>$v</option>";
	}
?>
	</select>
	学期<select name='xueqi'><option value=''>请选择</option>
		<option <?php if($xueqi==1){echo "selected";} ?> value="1">第一学期</option>
		<option <?php if($xueqi==2){echo "selected";} ?> value="2">第二学期</option>
	</select>
	<input type="submit" value="查询" id="submit" />