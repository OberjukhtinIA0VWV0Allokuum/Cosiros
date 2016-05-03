<?php
class CrMenu{
	var $DBD;
	public Function __construct(){
		global $core_database_driver;
		$this->DBD=$core_database_driver;
	}
	public Function MainMenu(){
		global $core_database_driver,$secret_parameters,$core_and_site_parameters; 
		$user=0;
		if ((!isset($_SESSION['ActivUser_rool'])) or $_SESSION['ActivUser_rool']==0){
			$user=1;
		} else {
			$user=$_SESSION['ActivUser_rool'];
		}
		$AllMenu='';//
		$thisitem='';
		$Inscape=array();
		$menuItem=new crTemplater("::","not faund","::");
		$menuItem->setTplFile($_SERVER['DOCUMENT_ROOT']."/stiles/".$core_and_site_parameters['site']['stile']."/menuitem.html");
		$sql = "SELECT * FROM `CrMenuTable` ";
		$sqlo=&$this->DBD->Execute($sql);
		$ADODB_FETCH_MODE = ADODB_FETCH_NUM;;
			while (!$sqlo->EOF) {
    		    if ($sqlo->fields[4]==1){
					if ($sqlo->fields[3]==$user or $sqlo->fields[3]==0){
						$Inscape['href']=$core_and_site_parameters['site']['adress'].$sqlo->fields[1];
						$Inscape['name']=$sqlo->fields[2];
						$menuItem->assign_vars($Inscape);
						$thisitem=$menuItem->render();
						$AllMenu=$AllMenu.$thisitem."";
					}
				}
				$sqlo->MoveNext();
			}
		return $AllMenu;	
	}
	public Function SecondMenu(){
		
	}
	public Function AddItemMainM($Url,$Name,$Roole){
		//print($url." - ".$name." - ".$Roole." - ");
		global $DataBaseName;
		//$this->DBD->debug=1;
		$sql = "INSERT INTO `".$DataBaseName."`.`CrMenuTable` (`id`, `url`, `name`, `type`, `menu`) VALUES (NULL, '".$Url."', '".$Name."', '".$Roole."', '1');";
		$a=&$this->DBD->Execute($sql);
		return $a;
	}
	public Function AddItemSecondM(){
		
	}
	public Function DeleteItem($itemId){
		global $DataBaseName;
		$sql = "UPDATE `".$DataBaseName."`.`CrMenuTable` SET  `menu` =  '9' WHERE  `crmenutable`.`id` =".$itemId.";";
		$a=&$this->DBD->Execute($sql);
		return $a;
	}
}
?>