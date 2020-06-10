<?php
	include("config.php");
	
	header('Content-Description: File Transfer'); 
	header('Content-Type: application/octet-stream'); 
	header('Content-Disposition: attachment; filename=file.csv'); 
	header('Content-Transfer-Encoding: binary'); 
	header('Expires: 0'); 
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0'); 
	header('Pragma: public'); 
	echo "\xEF\xBB\xBF";
	
	$sql->sql_connect();
	$result = $sql->sql_query("SELECT * FROM ".$sql->db_prefix."form ORDER BY id DESC");
	if($sql->sql_err){}
	else{
		if($sql->sql_rows($result)){
			echo implode(";",array("ФИО","Телефон","E-mail","Дата","Время"))."\n";
			while($query = $sql->sql_array($result)){
				unset($query["id"],$query["ifora_dt"]);
				echo implode(";",$query)."\n";
			}
		}
	}
	$sql->sql_close();
?>