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
		$secret_parameters, $iniParser, $core_and_site_parameters, $CoreTemplater,
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
	}
	public function Run(){
		global $Start_Parametrs,$_Debug,$CoreSystemEroorViewer,$core_and_site_parameters;
		$this->CoreTemplaterEng->setTplFile($_SERVER['DOCUMENT_ROOT']."/stiles/".$this->core_and_site_parametersEng['site']['stile']."/index.html");
		$menu='';
		$modul='';
		$Inscape= array();
		$modulsRunner=new CrCoreModulsRunner();
		if (empty($this->Start_ParametrsEng['moduls'])){
			$this->Start_ParametrsEng['moduls']=$core_and_site_parameters['site']['defaultmoduls'];
		}
		if (empty($this->Start_ParametrsEng['function'])){
			$this->Start_ParametrsEng['function']='FunDdefault';
		}
		$telo='';
		$modulsRunner->getModuls($this->Start_ParametrsEng['moduls']); 
		$telo=$modulsRunner->getRezult();
		$activFunction=$this->Start_ParametrsEng['function']."";
		if ($modulsRunner->getStatus()<>0){
			exit();
		} else {
			$Inscape['mod-autput']=$telo->$activFunction($this->Start_ParametrsEng['parameters']);
			switch ($this->Start_ParametrsEng['mode']){
				case 'json': $this->Work_Rezult=$Inscape['mod-autput']; break;
				case 'api': $this->Work_Rezult=$Inscape['mod-autput']; break;
				default:
					global $sistemUser,$head;
					$head->SetTitle($this->Start_ParametrsEng['moduls']);
					$copy= new crTemplater("::","not faund","::");
					$copy->setTplFile($_SERVER['DOCUMENT_ROOT']."/stiles/".$this->core_and_site_parametersEng['site']['stile']."/2stmenuinput.html");
					$footer=array();
					$footer['Copi-namme']=$this->core_and_site_parametersEng['site']['copy'];
					$footer['copi-yer']=$this->core_and_site_parametersEng['site']['copy_year'];
					$footer['copi-citi']=$this->core_and_site_parametersEng['site']['copy_city'];										
					$copy->assign_vars($footer);
					$Inscape['copy']=$copy->render();
					$Inscape['rights']=$this->core_and_site_parametersEng['site']['about_rights'];
					$Inscape['scripts']='';
					$Inscape['design']=$this->core_and_site_parametersEng['site']['admin_name']." (".$this->core_and_site_parametersEng['site']['admin_mail'].")";
					$Inscape['Main_adress']=$this->core_and_site_parametersEng['site']['adress'];
					$Inscape['org-name']=$this->core_and_site_parametersEng['site']['name'];
					$Inscape['anout-crat']=$this->core_and_site_parametersEng['site']['our_course'];
					$menu=new CrMenu();
					$Inscape['menu-inputs']=$menu->mainMenu();
					$Inscape['icon']=$sistemUser->GetUserWindow();
					$Inscape['header-input']=$head->render();
					$this->CoreTemplaterEng->assign_vars($Inscape);
					$this->Work_Rezult=$this->CoreTemplaterEng->render();
					break;
			}
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