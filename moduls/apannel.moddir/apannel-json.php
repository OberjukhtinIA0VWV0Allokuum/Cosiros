<?
class apannel extends parents_of_jqphp {
	function FunDdefault() {
		return "<script>redirecttomain();</script>";
	}
	function delitedmenu($arr){
		$menu=new CrMenu();
		$p=$menu->DeleteItem($arr[0]);
		print_r($p);
		return "Элемент меню удалён. <script>alert('Элемент меню удалён.');</script>";
	}
	function delitedmoduls($arr){
		$meneger=new ModMeneger();
		$meneger->delletemod($arr[0]);
		return "Модуль успешно удалён.<script>alert('Модуль успешно удалён.');</script>";
	}
	function adedmenu($arr){
		$menu=new CrMenu();
	//	print_r($arr);
		$p=$menu->AddItemMainM($arr[1],$arr[0],$arr[2]);
	//	print_r($p);
		return "Добавлен новый элемент меню.<script>alert('Добавлен новый элемент меню.');</script>";
	}
	function installmoduls($arr){
		$meneger=new ModMeneger();
		$meneger->installmod($arr[0]);
		return "Модуль установлен.<script>alert('Модуль установлен.');</script>";
	}
	function adedpage($arr){
		print_r($arr);
		$meneger=new ModMeneger();
		$menu=new CrMenu();
		$p=$menu->AddItemMainM("staticpage/printpage/".$arr[1],$arr[0],$arr[2]);
		$meneger->AddPage($arr[1],$arr[0]);
		return "Страница добавлена.<script>alert('Страница добавлена.');</script>";
	}
}
?>