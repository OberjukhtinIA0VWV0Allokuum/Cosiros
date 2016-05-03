<?php
session_start();
//функция CrDateTimeGet преобразует серверное время ко времени пользователя (с учетом разницы во времени)
//если не указана дата/время - берём текущее. Не указан шаблон - берём устнавленный по умолчанию.
class global_function{
function CrCopyDIrAll($from,$to){
$this->recurse_copy($from,$to);
}
function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                $this->recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 
function CrGetFileList($dir)
  {
    // массив, хранящий возвращаемое значение
    $retval = array();
    // добавляет конечный слеш, если была возвращена пустота
    if(substr($dir, -1) != "/") $dir .= "/";
    // указать путь до директории и прочитать список вложенных файлов
    $d = @dir($dir) or die("getFileList: Не удалось открыть каталог $dir для чтения");
    while(false !== ($entry = $d->read())) {
      // пропустить скрытые файлы
      if($entry[0] == ".") continue;
      if(is_dir("$dir$entry")) {
        $retval[] = array(
          "name" => "$dir$entry/",
          "size" => 0,
          "lastmod" => filemtime("$dir$entry")
        );
      } elseif(is_readable("$dir$entry")) {
        $retval[] = array(
          "name" => "$dir$entry",
          "size" => filesize("$dir$entry"),
          "lastmod" => filemtime("$dir$entry")
        );
      }
    }
    $d->close();
    return $retval;
  }
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
require_once "core/lib/ModulsMeneger.php";
require_once "core/lib/JsAdder.php";
$functions = new global_function();
global $functions;
$system_moduls=array('CrMenu','CrAdminPannel','CrUser');
$serverPath=$_SERVER['DOCUMENT_ROOT'];
global $serverPath;
$on_moduls=array();
$CoreTemplater= new crTemplater("::","not faund","::");
$iniParser=new iniFile("settings/site.ini");
$core_and_site_parameters=$iniParser->read();//print_r($core_and_site_parameters);
$iniParser->NewFile("settings/secret.ini");
$secret_parameters=$iniParser->read();
$DataBaseName=$secret_parameters['database']['db_name'];
global $DataBaseName;
$head=new CrHeaderConstruct($core_and_site_parameters['site']['title']);
$head->SetCharseft("utf-8");
//$head->SetIcon("favicon.ico");
$head->AddScriptFromFile($core_and_site_parameters['path']['code_js']."jquery-latest.min.js");
$head->AddScriptFromFile($core_and_site_parameters['path']['code_js']."jcore.js");
$head->AddScriptFromFile($core_and_site_parameters['path']['code_js']."jssmile.js");
$head->AddScriptFromFile($core_and_site_parameters['path']['code_js']."jsmine.js");
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