function home_do(obja)
{
	if(document.all)
	{
		obja.style.behavior='url(#default#homepage)';
		obja.setHomePage(document.location.href);
	}
	else
	{
		try
		{
			netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
		}
		catch(err) 
		{
			alert("抱歉！您的浏览器不支持直接设为首页。请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为“true”，点击“加入收藏”后忽略安全提示，即可设置成功。");
		}
		var objref = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
		objref.setCharPref('browser.startup.homepage', document.location.href);
	}
}

function favorite_do()
{
	if(document.all)
	{
		window.external.addFavorite(document.location.href, document.title)
	}
	else
	{
		window.sidebar.addPanel(document.title, document.location.href, '');
	}
}

$(document).ready(function(){
	$("#checkall").click(function(){
		ck = this.checked;
	  $("input[name='keylist[]']").each(function(){
	  	$(this).attr("checked",ck);});
	});
	$("select[name=s_major]").change(function(){
		year = $("select[name=s_year]").val();
		year = (typeof(year) == "undefined")? "" : year;
		$.get("jsondata.php?type=class&mid="+$(this).val()+"&year="+year,null,function(data){
			$("select[name=s_class]").html(data);
		});
	});
	$("select[name=s_year]").change(function(){
		mid = $("select[name=s_major]").val();
		mid = (typeof(mid) == "undefined")? "" : mid;
		$.get("jsondata.php?type=class&year="+$(this).val()+"&mid="+mid,null,function(data){
			$("select[name=s_class]").html(data);
		});
	});
});
