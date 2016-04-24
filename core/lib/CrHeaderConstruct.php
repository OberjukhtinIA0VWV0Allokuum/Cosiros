<?php
//php-code from: Leo-notebook
//auther: Oberjukhtin I.A. 
/* класс построения head-ов  Строит заголовки страниц, используется в Cris-cms*/
class CrHeaderConstruct{
	var $head=""; //переменная, куда сохраняем саму голову
	var $scripts=""; //переменная для скриптов (строка)
	var $icon=""; //строка-ссылка для подключения иконки
	var $siteName=""; //имя сайта
	var $meta=""; //мета-теги сохраняются здесь
	var $css=""; //ктт подключаются вот тут
	var $title=""; //заголовоок страницы
	var $begHead="";
	var $charseft="";
	var $endHead=""; //окончание страницы
	/*конструктор - создает экземпляр класса
	вход -=название_сайта=- (строка)
	 */
	public function __construct($sn){ 
	   $this->begHead = "<!-- This head is construct on CrHeaderConstruct -->"." "; //в коментариях пишем, кто написал заголовок (для того, чтобы было проще отслеживать "нечестные" модули и атаки)
	   $this->siteName=$sn;//запоминаем название сайта
	   $this->endHead="<!-- end head of the $sn -->";//создаем конечный комментарий заголовка
	}
	/* SetCss - Подключает Ктт.
	имеется возможнность подключить хоть сколько ктт.
	вход -=путь_до_ктт=- (строка)
	 */
	public function SetCss($pathToCSS){
		$this->css=$this->css." <link rel='stylesheet' type='text/css' href=".$pathToCSS."'/> ";
	}
	/* SetIcon - Подключает иконку.
	вход -=путь_до_иконки=- (строка)
	 */
	public function SetIcon($pathToIcon){
		$this->icon="<link rel='icon' href=".$pathToIcon." type='image/x-icon' />";
	}
	/* SetTitle - Задаёт заголловок страницы.
	вход -=заголовок=- (строка)
	 */
	public function SetTitle($title){
		$this->title="<title>".$title.". ".$this->siteName."</title>";
	}
	/* SetCharseft - Задаёт кодировку страницы.
	вход -=кодировка=- (строка)
	 */
	public function SetCharseft($chrsft){
		$this->charseft=" <meta http-equiv='content-type' content='text/html; charset=".$chrsft."' /> ";
	}
	/* AddScriptFromFile - Подключает файл скрипта.
	имеется возможнность подключить хоть сколько скриптов.
	вход -=путь_до_скрипта=- (строка)
	 */
	public function AddScriptFromFile($PathToJS){
		$this->scripts=$this->scripts.' <script type="text/javascript" src="'.$PathToJS.'"></script> ';
	}
	/* AddScriptFromFile - Подключае скрипта.
	имеется возможнность подключить хоть сколько скриптов.
	вход -=код_скрипта=- (строка)
	 */
	public function AddScript($JsCode){
		$this->scripts=$this->scripts.' <script type="text/javascript>'.$JsCode.'</script>';
	}
 	/* AddMeta - добавляет мета тег
	имеется возможнность подключить хоть сколько мета тегов.
	вход -=имя_тега=- (строка); -=значение=- (строка)
	 */
	public function AddMeta($MName,$MContent){
		$this->meta=$this->meta.' <meta name="'.$MName.'" content="'.$MContent.'" /> ';
	}
	/* render - склеивает страницу и возвращает заголовок
	вход -------
	выход -=сформированный заголовок=-
	 */	
	public function render(){
		$this->head=$this->begHead."   ".$this->meta."  ".$this->scripts."  ".$this->charseft."  ".$this->css."  ".$this->icon."  ".$this->title."  ".$this->endHead;
		return $this->head;
	}
}
?>