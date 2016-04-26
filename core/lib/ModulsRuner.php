<?php
//php-code from: Leo-notebook
//auther: Oberjukhtin I.A. 
/* --- */
//our code
Class CrCoreModulsRunner{
	var $DBD;
	var $rezult;
	var $status=0;
	public Function __construct(){
		 global $core_database_driver;
		 $this->DBD=$core_database_driver;
	}
	public function getModuls($name){
		global $_Debug,$Start_Parametrs,$CoreSystemEroorViewer,$iniParser,$on_moduls;
		$sql = "SELECT * FROM `CrListModuls` WHERE `urlname`='".$name."'";
		$sqlo=&$this->DBD->Execute($sql);
		$ModName=$sqlo->fields[2];
		if ( !$sqlo  or $ModName=="") {
			$this->Error404();
		} else {
			$path='';	
   			$path= $_SERVER['DOCUMENT_ROOT']."/moduls/".$ModName.".moddir/";
			$Ipath=$_SERVER['DOCUMENT_ROOT']."/moduls/".$ModName.".moddir/";
			$INIpath="moduls/".$ModName.".moddir/";  
			global $Start_Parametrs;
			$MeinFileOfModuls=''; 
			if ($Start_Parametrs['mode']==''){
				$MeinFileOfModuls=$Ipath.$ModName.".php";
				require_once "core/lib/parents/Parents_of_moduls.php";
			}
			global $Start_Parametrs;
			switch($Start_Parametrs['mode']){
				case 'json': $MeinFileOfModuls=$Ipath.$ModName."-json.php";
				require_once "core/lib/parents/Parents_of_jqueryphp.php";
				break;
				case "api": $MeinFileOfModuls=$Ipath.$ModName."-api.php"; 
				require_once "core/lib/parents/Parents_of_api.php";
				break;
				default: $MeinFileOfModuls=$Ipath.$ModName.".php"; 
				require_once "core/lib/parents/Parents_of_moduls.php";
				break;
			}
			if(file_exists($INIpath."manifest.ini")){
				$iniParser->newFile($INIpath."manifest.ini");
				$modSettings=$iniParser->Read();
				if(file_exists($MeinFileOfModuls)){
					require_once($MeinFileOfModuls);
					$modul=new $ModName($modSettings);
					$on_moduls[]=$ModName;
					$accords=$modSettings['core']['according_list'];
					$according_list=split(",",$accords);
					if (!$modSettings['core']['according']=="core_only"){
						foreach ($according_list as &$value) {
    						if (!in_arrey($value,$on_moduls)) {
								$this->getModuls($name);
							} 
						}
						unset($value);
					}
					$this->rezult=$modul;
				} else {$this->Error404(); }
			} else {$this->Error404(); }
		}
	$sqlo->Close();
	}
	private function Error404(){
		$this->status=1;
		header("Status: 404 Not Found");
		$html= "<center><h1>404</h1><hr>Sorry, in the script, caused by you, there are a few errors of syntax. Maybe the module is not instilied. If you are the administrator or owner of this domain, we recommend you to check the log file.<br>Perhaps the Website will answer by another query.</center>";
		print($html);
	}
	Function getStatus() {
		return $this->status;
	}
	Function getRezult() {
		return $this->rezult;
	}
}
?>