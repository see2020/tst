<?php 
	// форма обратной связи
	include("config.php");
?>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="#">
		<title>Форма обратной связи</title>
		<link href="/theme/bootstrap.min.css" rel="stylesheet">
		<script src="/theme/jquery-3.3.1.min.js"></script>
		<script src="/theme/bootstrap-formhelpers-phone.js"></script>
		<script src="/theme/validator.js"></script>
		<style>
			.form-group label{
				font-size:18px;
			}
			.ifora-req-field,
			.help-block{
				color: red;
				font-size:14px;
			}
			.ifora-info{
				font-size:14px;
			}
			#ifora-date, 
			#ifora-time{
				width: 180px;
				float: left;
				margin-right: 15px;
			}
			.ifora-results{
				display: none;
			}

		</style>
		<script type="text/javascript" language="javascript">
			$(document).ready(function() {

			});
			function snd() {
				var msg   = $('#ifora-form').serialize();
				$.ajax({
					type: 'POST',
					url: 'send.php',
					data: msg,
					success: function(data) {
						//if(data.trim().length == 'ok'){}else{}
						$('.ifora-form').hide();
						$('.ifora-results').show();
						if(data.trim().length == 'ok'){$('.f-val').val('');}
						$('.f-val').val('');
						$('#results').html(data);
					},
					error:  function(xhr, str){
						alert('Возникла ошибка: ' + xhr.responseCode);
					}
				});
			}
		</script>
	</head>
	<body>
		
		<div class="container ifora-form">
			<h1>Форма обратной связи</h1>
			<div class="row">
				<div class="col-xs-12">
					<p class="ifora-req-field">* - обязательные поля</p>
				</div>
				<div class="col-xs-12">

					<form id="ifora-form" method="post" data-toggle="validator" action="javascript:void(0);">
						<div class="form-group">
							<label for="ifora-fio">ФИО (полностью) <span class="ifora-req-field">*</span></label>
							<input type="text" name="ifora-fio" id="ifora-fio" class="form-control f-val" value="" data-required-error="Поле не заполнено" required >
							<span class="help-block with-errors"></span>
						</div>
						<div class="form-group">
							<label for="ifora-phone">Контактный телефон</label>
							<input type="tel" name="ifora-phone" id="ifora-phone" class="form-control bfh-phone f-val" value="" data-format="+7 (ddd) ddd-dddd"  pattern="(\+[\d\ \(\)\-]{16})" />
						</div>
						<div class="form-group">
							<label for="ifora-email">Контактный e-mail <span class="ifora-req-field">*</span></label>
							<input type="email" name="ifora-email" id="ifora-email" class="form-control f-val" value="" data-required-error="Поле не заполнено" required >
							<span class="help-block with-errors"></span>
						</div>
						<div class="form-group">
							<label for="ifora-date">Дата и время показа <span class="ifora-req-field">*</span></label>
							<div class="clearfix"></div>
							<input type="date" name="ifora-date" id="ifora-date" class="form-control f-val" value="<?php echo date("Y-m-d");?>" data-required-error="Поле не заполнено" required>
							<input type="time" name="ifora-time" id="ifora-time" class="form-control f-val" value="<?php echo date("H:i");?>" data-required-error="Поле не заполнено"	required>
							<div class="clearfix"></div>
							<span class="help-block with-errors"></span>
						</div>


						<div class="checkbox">
							<label>
								<input type="checkbox" name="ifora-agree" id="ifora-agree" data-required-error="" required>
								<span class="ifora-info">
								Я ознакомился с Положением об обработке персональных данных
								</span>
								<span class="help-block with-errors"></span>	
							</label>
						</div>
						<button type="submit" class="btn btn-default" onclick="$('ifora-form').off('submit');snd();">Отправить</button>
					</form>
					
				</div>
			</div>
		</div>	
		
		<div class="container ifora-results">
			<h1>Отправка формы</h1>
			<div class="row">
				<div class="col-xs-12" id="results"></div>
				<div class="col-xs-12"><a href="javascript:void(0);" onclick="$('.ifora-form').show();$('.ifora-results').hide();">Повторить ввод</a></div>
			</div>
		</div>	
		<div class="container">
			<div class="row">
				<div class="col-xs-12">Для примера <a href="adm.php">страница администратора</a></div>
			</div>
		</div>	
			
		<script src="/theme/bootstrap.min.js"></script>
	</body>
</html>				