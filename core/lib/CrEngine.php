<?php
//php-code from: Leo-notebook
//auther: Oberjukhtin I.A. 
/* --- */
//our code
class CrEngine {
	var $Work_Status="normal";
	var $Work_Errors='0';
	var $Work_Rezult='Huston,we have a problem';
	var $Start_ParametrsEng,$CoreSystemEroorViewerEng, $core_database_driverEng, $headEng, 
	$secret_parametersEng, $iniParserEng,  $core_and_site_parametersEng, $CoreTemplaterEng,
	$on_modulsEng, $MainPage, $system_modulsEng, $SystemRunnerEng, $sistemUserEng, $sistemCacherEng;
	public Function __construct(){		
		global $Start_Parametrs,$CoreSystemEroorViewer, $core_database_driver, $head, 
		$secret_parameters, $iniParser,  $core_and_site_parameters, $CoreTemplater,
		$on_moduls, $system_moduls, $SystemRunner, $sistemUser, $sistemCacher;
		$this->sistemCacherEng=$sistemCacher;
		$this->Start_ParametrsEng=$Start_Parametrs;
		//print_r($this->Start_ParametrsEng);
		$this->CoreSystemEroorViewerEng=$CoreSystemEroorViewer; 
		$this->core_database_driverEng=$core_database_driver;
		$this->headEng=$head;
		$this->secret_parametersEng=$secret_parameters;
		$this->iniParserEng=$iniParser;
		$this->core_and_site_parametersEng=$core_and_site_parameters;
		$this->CoreTemplaterEng=$CoreTemplater;
		$this->on_modulsEng=$on_moduls;
		$this->system_modulsEng=$system_moduls;
		$this->SystemRunnerEng=$SystemRunner;
		$this->sistemUserEng=$sistemUser;
		$this->core_and_site_parametersEng=$core_and_site_parameters; 
		//echo $_SERVER['DOCUMENT_ROOT']."/stiles/".$this->core_and_site_parametersEng['site']['stile']."/index.html   ";
	}
	public function Run(){
		global $_Debug,$CoreSystemEroorViewer;
		$this->CoreTemplaterEng->setTplFile($_SERVER['DOCUMENT_ROOT']."/stiles/".$this->core_and_site_parametersEng['site']['stile']."/index.html");
		$menu='';
		$modul='';
		$Inscape= array();
		$modulsRunner=new CrCoreModulsRunner();
		if (empty($this->Start_ParametrsEng['function'])){
			$this->Start_ParametrsEng['function']='FunDdefault';
		}
		$activFunction=$this->Start_ParametrsEng['function']."";
		$telo='';
		$modulsRunner->getModuls($this->Start_ParametrsEng['moduls']); 
		$telo=$modulsRunner->getRezult();
		if ($modulsRunner->getStatus()<>0){
			exit();
		} else {
				$Inscape['mod-autput']=$telo->$activFunction();
				$menu=new CrMenu();
				$Inscape['menu-inputs']=$menu->mainMenu();
				$Inscape['icon']='';
		$this->CoreTemplaterEng->assign_vars($Inscape);
		$this->Work_Rezult=$this->CoreTemplaterEng->render();
	}
	}
	public function GetStatus(){
		return $this->Work_Status;
	}
	public function GetRezult(){
		return $this->Work_Rezult;
	}
	public function GetErrorMessage(){
		return "Chto-to ne tak";
	} 
}
?>