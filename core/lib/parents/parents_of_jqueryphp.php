<?
class parents_of_jqphp{
	var $SistemGlobalsDrivers;
	var $DataBaseDrivers;
	var $ModulsParametrs;
	var $ModulsReturnedRezult='';
	var $ModulsStatus=0;
	final public function __construct($modulsStartParametrs){
		$SistemGlobalsDrivers=$GLOBALS;
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