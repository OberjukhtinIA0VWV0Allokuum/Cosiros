<?
class parents_of_moduls{
	var $SistemGlobalsDrivers;
	var $DataBaseDrivers;
	var $ModulsParametrs;
	var $ModulsReturnedRezult;
	var $ModulsStatus;
	final public function __construct($modulsStartParametrs){
		$SistemGlobalsDrivers=$GLOBALS;
		print_r($SistemGlobalsDrivers);
		echo "<br>";
		print_r($this->ModulsParametrs);
		$this->DataBaseDrivers=$global['core_database_driver'];
		$this->ModulsParametrs=$modulsStartParametrs;
	}
	final public function GetRezult(){
		if ($ModulsStatus==0)/*если статус 0 - отработали нормально, ошибок нет*/{
			return $ModulsReturnedRezult;
		} else {
			return $ModulsStatus;
		}		
	}
}
?>