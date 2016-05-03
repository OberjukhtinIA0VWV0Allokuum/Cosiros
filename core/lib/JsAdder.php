<?
class JsAdder{
	var $Js='';
	Function __construct(){}
	function AddScriptFromFile($file){
	//	$this->Js=$this->Js.' <script type="text/javascript">'.file_get_contents($file).'</script> ';
	}
	function render(){
		return $this->Js;
	}
	
}
?>