<?
Class tests extends parents_of_moduls {
	function FunDdefault() {
		$User=new users();
		return "Проверка зависимости. Подключение модуля users<hr>".$User->userslist();
	}
}
?>