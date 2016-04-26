<?
class parents_of_moduls{
	var $SistemGlobalsDrivers;
	var $DataBaseDrivers;
	var $ModulsParametrs;
	var $ModulsReturnedRezult='';
	var $ModulsStatus=0;
	var $modulsName='';
	final public function __construct($modulsStartParametrs){
		$SistemGlobalsDrivers=$GLOBALS;
		$this->DataBaseDrivers=$global['core_database_driver'];
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
?>