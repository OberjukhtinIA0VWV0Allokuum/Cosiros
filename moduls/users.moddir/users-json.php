<?
class users extends parents_of_jqphp {
	function FunDdefault() {
		return $this->capcha();
	}
	function exitr(){
		session_destroy();
		return "<script>redirecttomain();</script>";
	}
	function auth($arr){
		$rezult='nirma';
		if(count($arr)==3){
			$sql="SELECT * FROM  `CrUserMain` WHERE  `userlogin` =  '".$arr[0]."' AND  `userpassword` =  '".md5($arr[1])."'";
			$sqlo=&$this->DataBaseDrivers->Execute($sql);
			if ($sqlo){
				$_SESSION['ActivUser_id']=$sqlo->fields[0];
				$_SESSION['ActivUser_login']=$sqlo->fields[1];
				$_SESSION['ActivUser_name']=$sqlo->fields[2];
				$_SESSION['ActivUser_date']=$sqlo->fields[3];
				$_SESSION['ActivUser_rool']=$sqlo->fields[5];
				$_SESSION['ActivUser_mail']=$sqlo->fields[6];
				$_SESSION['ActivUser_phone']=$sqlo->fields[7];
				$_SESSION['ActivUser_region']=$sqlo->fields[8];
				$rezult= "вы вошли!<script>redirecttomain();</script>";								
			}else{
				$rezult="Неверная пара логин/пароль.";
			}
		} else {
			$rezult="Нужно заполнить все поля!";
		}
		return $rezult;
	}
	function registration($arr){
		$rezult='nirma';
		$pattern = '~^[0-9a-zа-яёA-ZА-ЯЁ\s_-]{7,20}$~ui';
		$patM='/.+@.+\..+/i';
		if (count($arr)==8){
			if($arr[6]==$_SESSION['capcha']){
				if($arr[4]==$arr[5]){
				 	if(preg_match($pattern, $arr[5])){
						/* if (preg_match($patM,trim($email))){
						 	$rezult="8765789";  */
							 if (preg_match($pattern, $arr[3])){
								if (preg_match($pattern, $arr[0])){
									if (!($arr[4]==$arr[0] or $arr[4]==$arr[1] or $arr[4]==$arr[3])) {
										$sql = "SELECT `userlogin` FROM `CrUserMain` where `userlogin`='".mysql_real_escape_string($arr[0])."'";
										$sqlo=&$this->DataBaseDrivers->Execute($sql);
											if ($arr[0]==$sqlo->fields[0]){
												return "Извините, но этот логин уже используется";
											}else{
												global $secret_parameters;
												$sql = "INSERT INTO `".$secret_parameters['database']['db_name']."`.`CrUserMain` (`id`, `userlogin`, `username`, `userdate`, `userpassword`, `userrools`, `useremeil`, `userphone`, `usercoutry`) VALUES (NULL, '".mysql_real_escape_string($arr[0])."', '".mysql_real_escape_string($arr[3])."', '".mysql_real_escape_string($arr[2])."', MD5('".mysql_real_escape_string($arr[4])."'), '2', '".mysql_real_escape_string($arr[1])."', NULL, NULL);";
												$sqlo=&$this->DataBaseDrivers->Execute($sql);
												if ($sqlo){
													$rezult= "вы зарегистрированы!<script>redirecttomain();</script>";
												} else{
													$rezult= "База не справилась с запросом. Проверьте адекватность введённых данных и повторите снова. ";
											}
										}
									} else {
										$rezult='В целях безопасности вашего аккаунта, пароль не может совпадать с e-mail, именем и логином пользователя';
									}
							 	}else{
									$rezult="Ваш логин нам не подходит. "; 
							 	} 
							 }else{
								$rezult="Ваше имя нам не подходит. "; 
							 }
							  /*
						 }else{
							$rezult="У вас точно этот адрес электронной почты? Как-то не похоже на e-mail."; 
						 }*/
					 }	else {
						$rezult="Ваш пароль не подходит. "; 
					 }
				}else{
					$rezult="Пароли не совадают. Повторите попытку.";
				}
			}else{
				$rezult="Не верно введена капча. Осторожней. ";
			}
		}else{
			$rezult="Заполните, пожалуйста, все поля.";
		}
		return $rezult;
	}
	function capcha(){
		global $core_and_site_parameters;
		$capData=$core_and_site_parameters['capcha'];
		$capletters =$capData ['capletters']; 
		$captlen = $capData['captlen']; 
		$capwidth = $capData['capwidth']; 
		$capheight = $capData['capheight']; 
		$capfont = $capData['capfont'];
		$capbegin = $capData['capbegin'];
		$capfontsize = $capData['capfontsize'];
		header('Content-type: image/png'); 
		$capim = imagecreatetruecolor($capwidth, $capheight); 
		imagesavealpha($capim, true); 
		$capbg = imagecolorallocatealpha($capim, 0, 0, 0, 127);
		imagefill($capim, 0, 0, $capbg); 
		$capcha = $capbegin;
		for ($i = 2; $i < $captlen; $i++){
			$capcha .= $capletters[rand(0, strlen($capletters)-1) ];
		}
		for ($i = 0; $i < $captlen; $i++){ 
			$x = ($capwidth - 20) / $captlen * $i + 10;
			$x = rand($x, $x+5); 
			$y = $capheight - ( ($capheight - $capfontsize) / 2 ); 
			$capcolor = imagecolorallocate($capim, rand(0, 100), rand(0, 100), rand(0, 100) ); 
			$capangle = rand(-25, 25); 
			imagettftext($capim, $capfontsize, $capangle, $x, $y, $capcolor, $capfont, $capcha[$i]);
		}
		$_SESSION['capcha'] = $capcha;
		imagepng($capim);
		imagedestroy($capim);		
	}
}
?>