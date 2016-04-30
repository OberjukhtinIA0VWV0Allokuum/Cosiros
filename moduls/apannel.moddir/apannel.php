<?
Class apannel extends parents_of_moduls {
	function FunDdefault() {
		global $head;
		$head->SetCss($this->thislpath."view.css");
//		$head->AddScriptFromFile('/core/js/jquery-latest.min.js');
		$head->SetTitle('Панель настроек');
		$form=file_get_contents($this->thislpath."pannel.html");
		return $form;
	}
}
?>