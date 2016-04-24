<?php
//php-code from: Leo-notebook
//auther: Oberjukhtin I.A. 
/* crTemplator -полнофункциональный мини-шаблонизатор, используемый в CrisCMS 
version: 1.0;
Version core: 0.1-2.3;
*/
class crTemplater {
	var $rightSim='';//символ открытия псевдотегв
	var $lefttSim='';//символ закрытия псевдотега
	var $tpl=''; //строка исходного шаблона
	var $out; //строка результата
	var $cash=false; // в данной версии хеширования нет - отключаем его
	var $is_NOok=true; // если что-то пошло не так - говорим тут "Истина", а так - ложь
	var $defaul=''; //Что пишем, если что-то пошло не так. 
	//в конструкторе устонавливаем значение по умолчания и границы псевдотегов
	public function crTemplater($left,$def,$right){
		$this->defaul=$def; //значение по умолчанию
		if ($left==""){ //если открывающий символ не задан
			$this->lefttSim="::"; //используем предопределённый
		} else {//иначе 
			$this->lefttSim=$left; //запоминаем открывающий символ
		}
		//для закрывающего поступаем аналогично
		if ($right==""){ //
			$this->rightSim="::";
		} else {
			$this->rightSim=$left;
		}
	}
	//устонавливаем шаблом строку -=вход - строка шаблона=-
	public function setTplTxt($text){
		$this->is_NOok=true; //тут никаких ошибок природой не заведено, но чтобы разрешить многократное использование одного и того же 
		//объекта шаблонизатора убираем за прошлым шалоном 
		$this->tpl=$text; //и применяем текст шаблона как наш шаблон
	}
	//функция смены настроек шаблонизатора
	public function settings($left,$def,$right){
		$this->defaul=$def; //значение по умолчанию
		if ($left=""){ //если открывающий символ не задан
			$this->lefttSim="::"; //используем предопределённый
		} else {//иначе 
			$this->lefttSim=$left; //запоминаем открывающий символ 
		}
		//для закрывающего поступаем аналогично
		if ($right=""){ //
			$this->rightSim="::";
		} else {
	  		$this->rightSim=$left;
		}
	}
	//устанавливаем шаблон файл -=вход - путь к файлу=-
	public function setTplFile($file){
		if (!file_exists($file)){ //если файл не читается 
			$this->is_NOok='0'; //говорим об этом
		}else{ //если читается
			$is_NOok='1'; //чистим за "прошлой реинкарнацией"
        	$this->tpl = file_get_contents($file); //читаем шаблон из файла
		}
	}
	//подставляем переменные -=вход - ассоциативный масссив=-
	public Function assign_vars($vars)
      {
	      	$this->out = $this->tpl; //берём шаблон из исходного шаблона
          	foreach( $vars as $blockname => $value ) //проходим по всем ключам из массива
          	{
				  $this->out = preg_replace('/'.$this->lefttSim . $blockname. $this->rightSim.'/i', $value, $this->out); //заменяем псевдотеги {::какой-нибудь_текст::} их значением
          	}
    	}
			  //выдаем результат трудов	
	public Function renderAB (){
		return $this->tpl;
	}
	public Function render (){ 
		$temp=$this->out;
		$this->out=$this->defaul;
		return $temp; //выводим результат
}
}
?>