<?php 

$email = htmlspecialchars($_POST["email"]);


$json = array(); 
	if (!$email) { 
		$json['error'] = 'Вы зaпoлнили поле.'; 
		echo json_encode($json); 
		die();
	}
	if(!preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $email)) { 
		$json['error'] = 'Нe вeрный фoрмaт почты.'; 
		echo json_encode($json); 
		die(); 
	}

	// Кодировка для отправленных писем 
	function mime_header_encode($str, $data_charset, $send_charset) { 
		if($data_charset != $send_charset)
		$str=iconv($data_charset,$send_charset.'//IGNORE',$str);
		return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
	}











/*
Форма обратной связи может получать сообщения с любых почтовых ящиков.
Исправлена проблема кодировки при получении писем почтовым клиентом Outlook.
Вы скачали её с сайта Epic Blog https://epicblog.net Заходите на сайт снова!
ВНИМАНИЕ! Лучше всего в переменную myemail прописать почту домена, который использует сайт. А не mail.ru, gmail и тд.
*/
if(isset($_POST['submit'])){
/* Устанавливаем e-mail Кому и от Кого будут приходить письма */    
	$to = $_POST['email']; // Здесь нужно написать e-mail, куда будут приходить письма	
    $from = "miukalka0179@gmail.com"; // Здесь нужно написать e-mail, от кого будут приходить письма, например no-reply@epicblog.net
	
/* ДЛЯ ПОЛЬЗОВАТЕЛЯ Устанавливаем e-mail Кому и от Кого будут приходить письма */    
	$to2 = "miukalka0179@gmail.com"; // Здесь нужно написать e-mail, куда будут приходить письма	
    $from2 = "kupryanovatanya@yandex.ru"; // Здесь нужно написать e-mail, от кого будут приходить письма, например no-reply@epicblog.net

/* Указываем переменные, в которые будет записываться информация с формы */
	$email = $_POST['email'];
    $subject = "Оформление подписки на новости Кибер-музея";//Фиксированная тема письма
	
/* ДЛЯ ПОЛЬЗОВАТЕЛЯ Указываем переменные, в которые будет записываться информация с формы */
	$email2 = $_POST['email'];
    $subject2 = "Оформление подписки на новости Кибер-музея";//Фиксированная тема письма
	
/* Проверка правильного написания e-mail адреса */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
show_error("<br /> Е-mail адрес не существует");
}
	
/* Переменная, которая будет отправлена на почту со значениями, вводимых в поля */
$mail_to_myemail2 = "Здравствуйте! 
Была оформлена подписка на новости Кибер-музея
E-mail пользователя: $email 
Чтобы ответить на письмо, создайте новое сообщение, скопируйте электронный адрес и вставьте в поле Кому.";	

$headers = "From: $from \r\n";

/* ДЛЯ ПОЛЬЗОВАТЕЛЯ Переменная, которая будет отправлена на почту со значениями, вводимых в поля */
$mail_to_myemail = "Здравствуйте! 
Вы оформили подписку на новости Кибер-музея
E-mail пользователя: $email2 
Спасибо, что сделали тестирование функций сайта! Пожалуйста, не отвечайте на это письмо, оно создано автоматически.";	
	
$headers2 = "From: $from2 \r\n";
	
/* Отправка сообщения, с помощью функции mail() */
    mail($to, $subject, $mail_to_myemail, $headers . 'Content-type: text/plain; charset=utf-8');    
	
/* ДЛЯ ПОЛЬЗОВАТЕЛЯ Отправка сообщения, с помощью функции mail() */
    mail($to2, $subject2, $mail_to_myemail2, $headers2 . 'Content-type: text/plain; charset=utf-8');
	
	
    echo "Вы оформили подписку на наши новости. Проверьте свою почту";
	echo "<br /><br /><a href='http://museum.tvk.su/'>Вернуться на сайт.</a>";
}
?>
<!--Переадресация на главную страницу сайта, через 2 секунды-->
<script language="JavaScript" type="text/javascript">
function changeurl(){eval(self.location="http://museum.tvk.su/");}
window.setTimeout("changeurl();",2000);
</script>
