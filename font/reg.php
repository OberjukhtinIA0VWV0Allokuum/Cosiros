<html>
<head>
	<script type="text/javascript" >  
	document.title = "Регистрация. CRISVW";</script>
	<title>Регистрация.</title>
	<meta http-equiv="Content-Type" content="text/html"  charset="utf-8">
	<link rel="stylesheet" href="2.css" type="text/css"> 
	<link rel="stylesheet" type="text/css" href="cal.css" />
	<script language="JavaScript" 
		type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
	<script language="javascript" type="text/javascript" src="http://rche.ru/examples/cal.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
	$('#calendar').simpleDatepicker();  // Привязать вызов календаря к полю с CSS идентификатором #calendar
	});
	</script>
</head>

<body>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script>
$(document).ready(function(){
$("#send").click(function(){
	 $("#er").css({'display':'block'});
 $("#teror").load("moduls/form_registr.php","name="+$("#na").val()+"&email="+$("#em").val()
 +"&famili="+$("#fn").val()+"&nic="+$("#nn").val()+"&pas="+$("#p1").val()+"&pas1="+$("#p2").val()+"&pas="+$("#p1").val()+"&capcha1="+$("#capcha").val());
 
})
});   
</script>
<div class="u">
	<small>Имя </small>*<br />
	<input type="text" size="20" name="na" id="na"/> <br>
	
	<small>Фамилия </small>*<br />
	<input type="text" size="20" name="fn" id="fn"/> <br>
	

	<small>Ник, если он есть (от 6 до 20 символов - русские, латинские буквы, цифры. Регистр не учитывается.) </small>*<br />
	<input type="text" size="20"name="nn" id="nn"/> <br>

	<small>Ваш действующий email </small>*<br /> 
	<input type="text" size="20" name="em" id="em"/> <br>
	

	<small>Пароль (от 6 до 20 символов - русские, латинские буквы, цифры. Регистр не учитывается.)</small> *<br />
	<input type="password" size="20" name="p1" id="p1"/> <br> 

	<br />*Повторите пароль<br />
	<input type="password" size="20" name="p2" id="p2"/> 

	<hr>

	<img id='capcha-image' src="moduls/captcha.php" width="160" height="40"><br>
	<input type="text" name="capcha"  id="capcha"><br>
	<a id="capchau" href="javascript:void(0);" onclick="document.getElementById('capcha-image').src='moduls/captcha.php?rid=' + Math.random();">Обновить</a> <br />
	<div class="u" id="er" style="display:none;"> <p id="teror"> </p> </div>
	<input id="send" type="button" value="Зарегистрироваться" />
</div>
</head>
</html>