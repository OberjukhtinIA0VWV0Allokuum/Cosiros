<?
Class staticpage extends parents_of_moduls {
	function FunDdefault() {
		global $core_and_site_parameters;
		$a=$arrayName = array();
		$a[0]=$core_and_site_parameters['site']['defaultpage'];
		return $this->printpage($a);
	}
	function printpage($arr){
		global $core_and_site_parameters,$head;
		$page=$arr[0];
		$returnedPage="Извините, не смог прочесть таблицу.";
		$sql="SELECT  `pathname`, `title` FROM  `CrStaticPage` WHERE  `urlname` =  '".$page."'";
		$sqlo=&$this->DataBaseDrivers->Execute($sql);
		$PathToPage=$_SERVER['DOCUMENT_ROOT']."/".$core_and_site_parameters['path']['static_page_folders'].$sqlo->fields[0].".html";
		$PathToCss=$core_and_site_parameters['path']['static_page_folders'].$sqlo->fields[0].".css";
		$head->SetCss($PathToCss);
		$head->SetTitle($sqlo->fields[1]);
		$returnedPage=file_get_contents($PathToPage);
		return $returnedPage;
	}
}
?>