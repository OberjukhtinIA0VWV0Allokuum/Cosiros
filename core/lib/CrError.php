<?
class ErrorSupervisor
{
	public function __construct()
	{
		// регистрация ошибок
		set_error_handler(array($this, 'OtherErrorCatcher'));
		// перехват критических ошибок
		register_shutdown_function(array($this, 'FatalErrorCatcher'));
		//регистрируем показ ошибок
		global $_Debug,$CoreSystemEroorViewer;
		// создание буфера вывода
		ob_start();
	}
		public function OtherErrorCatcher($errno, $errstr)
	{
		if ($_Debug){
			$error = error_get_last();
			$file=$_SERVER['DOCUMENT_ROOT'].'/core/log/errors_all.log';
			$fp = fopen($file,'a');
			if ($fp) {
				$date=date("[Y.m.j] H:i:s");
				$log="\r\n<Error> \r\n<title>\r\n<rang>\r\nnoncritic\r\n</rang>\r\n<Type>\r\n".$error['type']."\r\n</Type> \r\n<date>".
				$date."\r\n</date>\r\n<description>\r\n EROOR: '".$error['message']."' in file '".$error['file'].
				"' on line: ".$error['line']."\r\n</description>\r\n</Error>";
				fwrite($fp,$log);
		}
		}
		return false;
	}
	public function FatalErrorCatcher()
	{
			global $_Debug,$CoreSystemEroorViewer;
		$error = error_get_last();
		if (isset($error))
			if($error['type'] == E_ERROR
				|| $error['type'] == E_PARSE
				|| $error['type'] == E_COMPILE_ERROR
				|| $error['type'] == E_CORE_ERROR)
			{
				ob_end_clean();	// сбросить буфер, завершить работу буфера
				// контроль критических ошибок:
				$file=$_SERVER['DOCUMENT_ROOT'].'/core/log/errors_all.log';
				$fp = fopen($file,'a');
				if ($fp) {
					$date=date("[Y.m.j] H:i:s");
					$log="\r\n<Error> \r\n<title>\r\n<rang>\r\nCRITIC\r\n</rang>\r\n<Type>\r\n".$error['type']."\r\n</Type> \r\n<date>".
					$date."\r\n</date>\r\n<description>\r\n EROOR: '".$error['message']."' in file '".$error['file'].
					"' on line: ".$error['line']."\r\n</description>\r\n</Error>";
					fwrite($fp,$log);
					$CoreSystemEroorViewer->error500();
				}
				// - вернуть заголовок 500
				// - вернуть после заголовка данные для пользователя
					

			}
			else
			{
				ob_end_flush();	// вывод буфера, завершить работу буфера
			}
		else
		{
			ob_end_flush();	// вывод буфера, завершить работу буфера
		}
	}
}
?>