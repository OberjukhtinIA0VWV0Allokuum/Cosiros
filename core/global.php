<?php
require_once "core/lib/crTemplater.php";
require_once "core/lib/iniFile.php";
require_once "core/lib/ADODB/adodb.inc.php";
require_once "core/lib/ADODB/toexport.inc.php";
require_once "core/lib/CrHeaderConstruct.php";
require_once "core/lib/User_class.php";
require_once "core/lib/CrMenu.php";
require_once "core/lib/ModulsRuner.php";
require_once "core/lib/cacher.php";
require_once "core/lib/parents/Parents_of_api.php";
require_once "core/lib/parents/Parents_of_moduls.php";
require_once "core/lib/CrEngine.php";
require_once "users-libs/php/includeList.php";
require_once "core/lib/CrMenu.php";
$system_moduls=array('CrMenu','CrAdminPannel','CrUser');
$on_moduls=array();
$CoreTemplater= new crTemplater("::","not faund","::");
$iniParser=new iniFile("settings/site.ini");
$core_and_site_parameters=$iniParser->read();//print_r($core_and_site_parameters);
$iniParser->NewFile("settings/secret.ini");
$secret_parameters=$iniParser->read();
$head=new CrHeaderConstruct($core_and_site_parameters['site']['title']);
$head->SetCharseft("utf-8");
$head->SetIcon("favicon.ico");
$head->AddScriptFromFile($core_and_site_parameters['path']['code_js']."jquery-latest.min.js");
$core_database_driver = &ADONewConnection('mysql');
$core_database_driver->Connect($secret_parameters['database']['db_server'], $secret_parameters['database']['db_username'], $secret_parameters['database']['db_key'], $secret_parameters['database']['db_name']);
$url = split("/",$_GET['url']);
$Start_Parametrs['function']=$url[1];
$url1 = split("[.]",$url[0]);
if ($url1[1]){
	switch($url1[1]){
		case "json": $Start_Parametrs['mode']='json'; break;
		case "api": $Start_Parametrs['mode']='api'; break;
		case "API": $Start_Parametrs['mode']='api'; break;		
		case "TV": $Start_Parametrs['mode']='tv'; break;
		case "tv": $Start_Parametrs['mode']='tv'; break;
		case "ios": $Start_Parametrs['mode']='ios'; break;
		case "android": $Start_Parametrs['mode']='android'; break;
		case "mobile": $Start_Parametrs['mode']='mobile'; break;
		case "future": $Start_Parametrs['mode']='future'; break;
		default: $Start_Parametrs['mode']='web'; break;
	}
} else {
$Start_Parametrs['mode']="Web";
}
$Start_Parametrs['moduls']=$url1[0];
array_shift($url);
array_shift($url);
$Start_Parametrs['parameters']=$url;
$SystemRunner= new CrCoreModulsRunner();
$sistemUser= new CrCoreUserAuth();
$sistemCacher= new CrCash();
global $Start_Parametrs,$CoreSystemEroorViewer, $core_database_driver, $head, 
$secret_parameters, $iniParser,  $core_and_site_parameters, $CoreTemplater,
$on_moduls, $system_moduls, $SystemRunner, $sistemUser, $sistemCacher;
$engine=new CrEngine();
$OutputRezult='';
$engine->Run();
$OutputRezult=$engine->GetRezult();
print($OutputRezult);
?>