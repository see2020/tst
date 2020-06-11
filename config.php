<?php
	header("Content-Type: text/html; charset=utf-8");
	
	// настроки
	$ArrConfig["Rows"]		 = 5;
	$ArrConfig["MailTo"]	 = "admin@admin.adm";
		
	include_once("other.php");
	$sql = new class_sql;

	$sql->sql_set("login","denis");
	$sql->sql_set("passwd","denis");
	$sql->sql_set("database","ifora");
	$sql->sql_set("host","localhost");
	$sql->sql_set("db_prefix","ifora_");
	$sql->sql_set("codepage","utf8");
?>