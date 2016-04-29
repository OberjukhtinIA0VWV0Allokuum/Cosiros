<?
class parents_of_jqphp{
	var $DataBaseDrivers;
	var $ModulsParametrs;
	var $ModulsReturnedRezult='';
	var $ModulsStatus=0;
	var $modulsName='';
	var $globalpath;
	var $thislpath;
	final public function __construct($modulsStartParametrs,$IniPath,$path){
		$this->globalpath=$path;
		$this->thislpath=$IniPath;
		global $core_database_driver;
		$this->DataBaseDrivers=$core_database_driver;
		$this->ModulsParametrs=$modulsStartParametrs;
		$this->modulsName=$this->ModulsParametrs['info']['name'];
	}
	final public function GetModulName(){
		return($this->modulsName);
	}
	final public function GetModulSett(){
		$this->ModulsParametrs->readStringIni();
	}
}
//
?>