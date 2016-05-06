<?
Class CrCoreUserAuth{
	var $activUser;
	Function _cunstruct(){
		global $core_database_driver;
		$this->DataBaseDrivers=$core_database_driver;
	}
	Function GetUser($user=0){
		$userRet =  array();
		if ($user==0){
			$userRet['id']=$_SESSION['ActivUser_id'];
			$userRet['login']=$_SESSION['ActivUser_login'];
			$userRet['name']=$_SESSION['ActivUser_name'];
			$userRet['date']=$_SESSION['ActivUser_date'];
			$userRet['rool']=$_SESSION['ActivUser_rool'];
			$userRet['mail']=$_SESSION['ActivUser_mail'];
			$userRet['phone']=$_SESSION['ActivUser_phone'];
			$userRet['region']=$_SESSION['ActivUser_region'];
		} Else {
			$sql="SELECT * FROM  `CrUserMain` WHERE  `userlogin` =  '".$user."' or  `id` =  '".$user."'";
			$sqlo=&$this->DataBaseDrivers->Execute($sql);
			if ($sqlo){
				$userRet['ActivUser_id']=$sqlo->fields[0];
				$userRet['ActivUser_login']=$sqlo->fields[1];
				$userRet['ActivUser_name']=$sqlo->fields[2];
				$userRet['ActivUser_date']=$sqlo->fields[3];
				$userRet['ActivUser_rool']=$sqlo->fields[5];
				$userRet['ActivUser_mail']=$sqlo->fields[6];
				$userRet['ActivUser_phone']=$sqlo->fields[7];
				$userRet['ActivUser_region']=$sqlo->fields[8];
			}	
		}
		return $userRet;
	}
	Function GetUserWindow(){
		$UserInfo='';
		if ((!isset($_SESSION['ActivUser_rool']) or $_SESSION['ActivUser_rool']==0)){
			$UserInfo="Приветствую, <span>Незнакомец</span>!<br>Пожалуйста, <a href='".$core_and_site_parameters['site']['adress']."/users/authn/'>войди в систему</a> или <a href='".$core_and_site_parameters['site']['adress']."/users/registration/'>зарегистрируйся</a>.";
		}else{
			$UserInfo="Приветствую, <span>".$_SESSION['ActivUser_name']." (".$_SESSION['ActivUser_login'].")</span>!<br><a href='".$core_and_site_parameters['site']['adress']."/users/userslist/'>Кто тут есть?</a> | <a href='".$core_and_site_parameters['site']['adress']."/users/exitr/'>Выйти.</a>.";
		}
		//$glob= new global_function();
		//=$UserInfo."<hr> Страница создана: ".$glob->CrDateTimeGet();		
		return($UserInfo);
	}
}
?>