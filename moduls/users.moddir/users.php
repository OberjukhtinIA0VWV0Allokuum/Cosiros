<?//
Class users extends parents_of_moduls {
	function FunDdefault() {
		return $this->userslist();
	}
	function exitr(){
		session_destroy();
		return "<script>redirecttomain();</script>";
	}
	function registration($arr){
		if(isset($_SESSION['ActivUser_date'])){
			return "<script>redirecttomain();</script>";
		}
		global $head;
		$head->SetCss($this->thislpath."formregistr/view.css");
//		$head->AddScriptFromFile('/core/js/jquery-latest.min.js');
		$head->SetTitle('Регистрация');
		$form=file_get_contents($this->thislpath."formregistr/registr.html");
		return $form;
	}
	function authn(){
		if(isset($_SESSION['ActivUser_date'])){
			return "<script>redirecttomain();</script>";
		}
		global $head;
		$head->SetCss($this->thislpath."formauth/view.css");
//		$head->AddScriptFromFile('/core/js/jquery-latest.min.js');
		$head->SetTitle('Вход');
		$form=file_get_contents($this->thislpath."formauth/auth.html");
		return $form;
	}
	function userslist(){
		$returntable= "<center> Cписок пользователей: <hr> <table width='100%'> <tr>";
		$sql="SELECT * FROM  `CrUserMain`";
		$sqlo=&$this->DataBaseDrivers->Execute($sql);
		while (!$sqlo->EOF){
			$returntable=$returntable."<td>".$sqlo->fields[1]."</td><td>".$sqlo->fields[2]."</td><td>".$sqlo->fields[3]."</td><td>".$sqlo->fields[6]."</td></tr><tr>";
			$sqlo->MoveNext();
		}
		$returntable=$returntable."</tr></table></center>";
		return $returntable;
	}
	function capcha(){
		$word="alert(&quotТебе что, нечем больше заннятся? Упоролся.&quot);";
		$word2="document.getElementById('capcha-image').src='http://testmasteke.leo/users.jq/capcha?rid=' + Math.random(); ";
		return "<center>Посмотри, какая забавная капча у нас. <br> Она всегда принимает форму телефонного номера<hr><img id='capcha-image' src='http://testmasteke.leo/users.jq/capcha' width='160' height='40' alt='нажми F5, чтобы получить другую)'><br><a href='javascript:void(0);' onclick=$word2 >Дальше</a>	|	<a href='javascript:void(0);' onclick='$word'>Оппа! Это ж мой номер!</a> <hr>Спорим, и твой есть в базе? Шучу, никакой базы нет, просто такой генератор. "./*<br><input type='text' name='capcha'  id='capcha'>.*/"<br> <h1>Убедительная просьба, не звонить по этому номеру - вдруг человек очень занят.</h1><center>";
	}
}
?>