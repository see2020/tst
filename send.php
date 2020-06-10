<?php
	include("config.php");
	
	$save = true;
	
	$ArrSave["ifora_fio"]	 = clear_str($_POST["ifora-fio"]);
	$ArrSave["ifora_phone"]	 = clear_phone($_POST["ifora-phone"]);
	$ArrSave["ifora_email"]	 = (check_mail($_POST["ifora-email"]))?trim($_POST["ifora-email"]):"";
	$ArrSave["ifora_date"]	 = clear_date($_POST["ifora-date"]);
	$ArrSave["ifora_time"]	 = clear_time($_POST["ifora-time"]);
	$ArrSave["ifora_dt"]	 = 0;
	if($ArrSave["ifora_fio"] == ""){
		echo "Поле \"ФИО\" не заполнено";
		$save = false;
	}
	if($ArrSave["ifora_email"] == ""){
		echo "Поле \"Контактный e-mail\" не заполнено, либо заполненно не корректно";
		$save = false;
	}
	if($ArrSave["ifora_date"] == "" || $ArrSave["ifora_time"] == ""){
		echo "Поле \"Дата и время показа\" не заполнено";
		$save = false;
	}
	else{
		$ArrSave["ifora_dt"] = strtotime($ArrSave["ifora_date"]." ".$ArrSave["ifora_time"].":00");
	}

	if($save){
		$sql->sql_connect();
		$sql->sql_ExpandArr($ArrSave);
		if(!$sql->sql_insert("form")){
			echo "Ошибка отправки формы. Попробуйте позже. ";
			echo $sql->sql_err;
		}
		else{
			// отправка сообщения на контактный e-mail
			
			// Сообщение
			// $message = "Line 1\r\nLine 2\r\nLine 3";
			// На случай если какая-то строка письма длиннее 70 символов мы используем wordwrap()
			// $message = wordwrap($message, 70, "\r\n");
			// Отправляем
			// mail('caffeinated@example.com', 'My Subject', $message);
			
			$subject = "Новое сообщение для администратора";
			$message = "";
			$headers = "From: ".$ArrConfig["MailTo"]."\r\n".
				"Reply-To:  ".$ArrConfig["MailTo"]."\r\n".
				"X-Mailer: PHP/Form";
			mail($ArrConfig["MailTo"], $subject, $message, $headers);

			echo "ok";
			
			
		}
		$sql->sql_close();
	}

	

	
	
// [ifora-fio] => qwe
// [ifora-phone] => +7 (456) 654-6546
// [ifora-email] => sdfsf@sdf.df
// [ifora-date] => 2020-06-18
// [ifora-time] => 11:10
	
?>