<?
Class mydevice extends parents_of_moduls {
	function FunDdefault() {
		return "какая-то фиигня, которую модуль должен вернуть по умолчанию.";
	}
	function arr1($arr){
		return "какая-то фиигня, которую модуль должен вернуть при вызове функции arr1.";
	}
	function info(){
		return "Получаем информацию о модуле. (знаю, что глупо, но всё же). <hr>".$this->GetModulSett."<hr>".$this->GetModulName();
	}
}
?>