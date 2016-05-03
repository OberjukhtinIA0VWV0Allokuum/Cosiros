<?
Class apannel extends parents_of_moduls {
	function FunDdefault() {
		if(!$_SESSION['ActivUser_date']==3){
			return "<script>
			alert('Какой хитрый хацкер!'); 
			redirecttomain();</script>";
		}
		global $functions,$core_and_site_parameters,$head;
		$head->SetTitle('Панель настроек');
		$page = new crTemplater('',"ouuu Печалька, я не смог прочитать шаблончик.",'');
		$page->setTplFile($this->thislpath."pannel.html");
		$ListItem=new crTemplater(''," ouuu Печалька, я не смог прочитать шаблончик.",'');
		$ListItem->setTplFile($this->thislpath."opton.html");
		$Inscape= array();
		//создание списка активных панелей меню
		$sql = "SELECT `id`, `name` FROM `CrMenuTable` WHERE `menu`<4";
		$sqlo=&$this->DataBaseDrivers->Execute($sql);
		$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
		$ListItemMenuForDelited='';
		$InscVal=array();
		$InscVal['dost']='';
		while (!$sqlo->EOF) {
			$InscVal['val']=$sqlo->fields[0];
			$InscVal['name']=$sqlo->fields[1];
			$ListItem->assign_vars($InscVal);
			$ListItemMenuForDelited=$ListItemMenuForDelited.$ListItem->render();
			$sqlo->MoveNext();
		}
		$Inscape['ActivMenuList']=$ListItemMenuForDelited;
        //создание списка модулей
		$ListItem->setTplFile($this->thislpath."opton.html");
		$sql = "SELECT  `id` ,  `urlname`  FROM  `CrListModuls` where `issystems`=0 and `blockedmoduls` =0";
		$sqlob=&$this->DataBaseDrivers->Execute($sql);
		$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
		$ListModulsForDelited='';
		$InscVa=array();
		while (!$sqlob->EOF) {
			$InscVa['val']=$sqlob->fields[0];
			$InscVa['name']=$sqlob->fields[1];
			$ListItem->assign_vars($InscVa);
			$ListModulsForDelited=$ListModulsForDelited.$ListItem->render();
			$sqlob->MoveNext();
		}
		$Inscape['ActivModulsList']=$ListModulsForDelited;
        
		//создание списка установочных пакетов
		$DirList=$functions->CrGetFileList($core_and_site_parameters['path']['mod_for_install']);
		$listmodforinstal='';
		foreach ( $DirList as $value ){
			$InscVal=array();
			$InscVal['dost']='';
			$r=split("/",$value['name']);
			$r=$r[2];
			$r=split("\.",$r);
			$InscVal['val']=$InscVal['name']=$r[0];
			$ListItem->assign_vars($InscVal);
			$listmodforinstal=$listmodforinstal.$ListItem->render(); 
		}
		//сам вывод
		$Inscape['ListForInstal']=$listmodforinstal;
		$page->assign_vars($Inscape);		
		$form=$page->render();//file_get_contents($this->thislpath."pannel.html");
		return $form;
	}
}
?>