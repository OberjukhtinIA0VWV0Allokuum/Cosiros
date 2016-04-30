<?php
session_start();
//функция CrDateTimeGet преобразует серверное время ко времени пользователя (с учетом разницы во времени)
//если не указана дата/время - берём текущее. Не указан шаблон - берём устнавленный по умолчанию.
class global_function{
function CrDateTimeGet($time=0,$templatetime=''){
	$returnedTimeDate='';
	if($templatetime==''){
		global $core_and_site_parameters;
		$templatetime=$core_and_site_parameters['site']['default_time_template'];
	}
	if ($time==0){
		$date = date(date("Y-m-d H:i:s"));
		$returnedTimeDate=date($templatetime, strtotime($_SESSION['Delta_Time_h']." hours ".$_SESSION['Delta_Time_m']." minutes", strtotime($date)));		
	}else{
		$returnedTimeDate=date($templatetime, strtotime($_SESSION['Delta_Time_h']." hours ".$_SESSION['Delta_Time_m']." minutes", strtotime($tame)));
	}
	return $returnedTimeDate;
}
}
require_once "core/lib/crTemplater.php";
require_once "core/lib/iniFile.php";
require_once "core/lib/ADODB/adodb.inc.php";
require_once "core/lib/ADODB/toexport.inc.php";
require_once "core/lib/CrHeaderConstruct.php";
require_once "core/lib/User_class.php";
require_once "core/lib/CrMenu.php";
require_once "core/lib/ModulsRuner.php";
require_once "core/lib/cacher.php";
require_once "core/lib/CrEngine.php";
require_once "users-libs/php/includeList.php";
require_once "core/lib/CrMenu.php";
$system_moduls=array('CrMenu','CrAdminPannel','CrUser');
$serverPath=$_SERVER['DOCUMENT_ROOT'];
global $serverPath;
$on_moduls=array();
$CoreTemplater= new crTemplater("::","not faund","::");
$iniParser=new iniFile("settings/site.ini");
$core_and_site_parameters=$iniParser->read();//print_r($core_and_site_parameters);
$iniParser->NewFile("settings/secret.ini");
$secret_parameters=$iniParser->read();
$head=new CrHeaderConstruct($core_and_site_parameters['site']['title']);
$head->SetCharseft("utf-8");
//$head->SetIcon("favicon.ico");
$head->AddScriptFromFile($core_and_site_parameters['path']['code_js']."jquery-latest.min.js");
$core_database_driver = &ADONewConnection('mysql');
$core_database_driver->charSet = 'utf8_unicode_ci';
$core_database_driver->Connect($secret_parameters['database']['db_server'], $secret_parameters['database']['db_username'], $secret_parameters['database']['db_key'], $secret_parameters['database']['db_name']);
$core_database_driver->Execute("SET NAMES 'utf8'");
$core_database_driver->Execute("SET CHARACTER SET 'utf8'");
$url = split("/",$_GET['url']);
$Start_Parametrs['function']=$url[1];
$url1 = split("[.]",$url[0]);
if (!empty($url1[1])){
	switch($url1[1]){
		case 'jq': $Start_Parametrs['mode']='json'; break;
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
$Start_Parametrs['mode']="web";
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