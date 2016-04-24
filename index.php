<?php
// старттовый сценарий (1) - определяет, подсчитана ли разница между клиентским и серверным временем, подгружает саму систему.
//готов - 10.10.2015
//Реализация - Оберюхтин (Белый_Волк) Иван
//последние изменения -
//string ini_set (, string newvalue);
session_start();//запускаем нашу сессию
$_Debug=FALSE;
require_once "core/lib/ErrorViewer.php";
$CoreSystemEroorViewer= new CrCoreErrorViewer();
require_once("core/lib/CrError.php"); //подключаем обработчик ошибок
$errorController = new ErrorSupervisor(); // запускаем его
if ((isset($_SESSION['is_delta_time']))and ($_SESSION['is_delta_time'] == '1')){
	require_once "core/global.php"; //если разница во 
} else {
	$html=" <script src='core/js/jquery-latest.min.js'></script>
	<Script>
	var d = new Date();
		$(document).ready(function(){
 $('#inner').load('core/deltatime.php','h='+d.getHours()+'&m='+d.getMinutes());
});
	</script>
	<div id='inner'></div>";
	echo $html;
}
?>