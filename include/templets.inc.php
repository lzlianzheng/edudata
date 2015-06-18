<?php
require_once 'templets.class.php';
require_once 'templets.func.php';
require_once 'article.class.php';
require_once 'product.class.php';
require_once 'link.class.php';
require_once 'user.class.php';
require_once 'category.class.php';

$tempinfo = new Templets;
$templets = $tempinfo->GetDefaultTemplets();
if($templets == null)
{
    $templets->directory = "default";    
}
$tempinfo->template_dir = YIQIROOT.'/templets/'.$templets->directory.'/';
$tempinfo->assign("templets",$templets);
$tempinfo->compile_dir = YIQIROOT.'/cache/compile/';

$sql = "select * from yiqi_settings";
$settinglist = $yiqi_db->get_results(CheckSql($sql));
if(count($settinglist)>0)
{
    foreach($settinglist as $settinginfo)
    {
			if($settinginfo->varname == "sitecopy")
			{
        $tempinfo->assign($settinginfo->varname,str_replace("\n", "<br/>", $settinginfo->value));
			}else if($settinginfo->varname == "aboutimg" || $settinginfo->varname == "productimg" || $settinginfo->varname == "servicexmimg" || $settinginfo->varname == "servicelcimg" || $settinginfo->varname == "jobimg"){
				$tempinfo->assign($settinginfo->varname,$settinginfo->value);
				$tempinfo->assign($settinginfo->varname."url",$settinginfo->description);
			}else if(strpos($settinginfo->varname,"about_") === false){
				$tempinfo->assign($settinginfo->varname,$settinginfo->value);
			}
    }
}

$categorydata = new Category;
$categorylist = $categorydata->GetSubCategory(0,"product");
$tempinfo->assign("categorylist",$categorylist);

$tempinfo->register_function("formaturl","formaturl");

$articledata = new Article;
$productdata = new Product;
$categorydata = new Category;
$linkdata = new Link;
$userdata = new User;
$tempinfo->assign_by_ref("articledata",$articledata);
$tempinfo->assign_by_ref("productdata",$productdata);
$tempinfo->assign_by_ref("categorydata",$categorydata);
$tempinfo->assign_by_ref("linkdata",$linkdata);
$tempinfo->assign_by_ref("userdata",$userdata);
$tempinfo->assign_by_ref("yiqi_cms_version",$cfg_yiqi_cms_version);
?>
