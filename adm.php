<?php 
	include("config.php");
?>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="#">
		<title>Страница администратора</title>
		<link href="/theme/bootstrap.min.css" rel="stylesheet">
		<script src="/theme/jquery-3.3.1.min.js"></script>
	</head>
	<body>
		
		<div class="container">
			<h1>Список заявок</h1>
			<div class="row">
				<div class="col-xs-2"><a href="index.php">Вернуться к форме</a></div>
				<div class="col-xs-2"><a href="csv.php">CSV</a></div>
				<div class="col-xs-2"><a href="excel.php">XLS</a></div>
			</div>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
<?php
	
	$sql->sql_connect();
	if(isset($_GET['pagenum']) && @$_GET['pagenum'] != 0){$pg = (int)$_GET['pagenum'];}else{$pg = 1;}
	$rowCount = $sql->sql_rows($sql->sql_query("SELECT * FROM `".$sql->db_prefix."form`"));
	$rowStart = page_get_count($pg,$rowCount,$ArrConfig["Rows"]);
	$result = $sql->sql_query("SELECT * FROM ".$sql->db_prefix."form
	ORDER BY id DESC LIMIT ".$rowStart.",".$ArrConfig["Rows"]);
	if($sql->sql_err){echo "Ошибка получения списка записей ".$sql->sql_err;}
	else{
		if($sql->sql_rows($result)){
			echo "<table class=\"table table-striped\">";
			echo "<thead>";
			echo "<tr>";
			echo "<th>№</th>";
			echo "<th>Дата</th>";
			echo "<th>Время</th>";
			echo "<th>ФИО</th>";
			echo "<th>E-mail</th>";
			echo "<th>Телефон</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			while($query = $sql->sql_array($result)){
				echo "<tr>";
				echo "<td>".$query["id"]."</td>";
				echo "<td>".$query["ifora_date"]."</td>";
				echo "<td>".$query["ifora_time"]."</td>";
				echo "<td>".$query["ifora_fio"]."</td>";
				echo "<td>".$query["ifora_email"]."</td>";
				echo "<td>".$query["ifora_phone"]."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo page_list_show($pg,$rowCount,$ArrConfig["Rows"],"/adm.php");
		}
		else{
			echo "Записей нет";
		}				
	}
	$sql->sql_close();
?>					
					
					
				</div>
			</div>
		</div>	
		
		
		
		
		<script src="/theme/bootstrap.min.js"></script>
	</body>
</html>		