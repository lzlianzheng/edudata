$(document).ready(function(){
	$.get("getcate.php?type=cate&cid=0",function(data){
		$("#prolist").html(data);
	});
});
