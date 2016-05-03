<?php
//php-code from: Leo-notebook
//auther: Oberjukhtin I.A. 
/* --- */
//our cod
class ModMeneger{
		var $DBD;
	var $rezult;
	var $status=0;
	public Function __construct(){
		 global $core_database_driver;
		 $this->DBD=$core_database_driver;
	}
	function installmod($name){
		global  $DataBaseName,$core_and_site_parameters,$functions;
		$path=$core_and_site_parameters['path']['mod_for_install'].$name.".modpacdir";
		require_once($path."/SqlInst.php");
		if (count($sql)>0){
			for ($i=0; $i<count($sql); $i++){
				$a=&$this->DBD->Execute($sql);
			}
		} 
		$functions->CrCopyDIrAll($path."/",$core_and_site_parameters['path']['active_moduls']);
		$sql="INSERT INTO ".$DataBaseName.".`CrListModuls` (`id`, `urlname`, `pathname`, `issystems`, `dateinstall`, `urlinfo`, `creatermail`, `creatername`, `blockedmoduls`) VALUES (NULL, '".$name."', '".$name."', '0', '', '', '', '', '0');";
		$a=&$this->DBD->Execute($sql);
		return $path;
	}
	function delletemod($id){
		global $DataBaseName;
		$sql="UPDATE  `".$DataBaseName."`.`CrListModuls` SET  `blockedmoduls` =  '1' WHERE  `crlistmoduls`.`id` =".$id.";";
		$a=&$this->DBD->Execute($sql);
		return $a;
	}
	Function AddPage($name,$title){
		global $DataBaseName;
		$sql="INSERT INTO ".$DataBaseName.".`CrStaticPage` (`id`, `urlname`, `pathname`, `typepage`, `rightpage`, `title`) VALUES (NULL, '".$name."', '".$name."', '".$title."', '', 'что-нибудь');";
		$a=&$this->DBD->Execute($sql);
		return $a;
	}
}
?>