<?php
	
	include("config.php");
	require_once('excel/PHPExcel.php');
	$xls = new PHPExcel();
	$xls->setActiveSheetIndex(0);
	$sheet = $xls->getActiveSheet();
	$sheet->setTitle('Список');
	
	$sheet->getColumnDimension('A')->setWidth(35);
	$sheet->getColumnDimension('B')->setWidth(17);
	$sheet->getColumnDimension('C')->setWidth(30);
	$sheet->getColumnDimension('D')->setWidth(13);
	$sheet->getColumnDimension('E')->setWidth(8);	
	
	$sheet->setCellValue("A1", 'Список');
	$sheet->getStyle("A1")->getFont()->setBold(true);
	$sheet->mergeCells("A1:E1");
	$sheet->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
	$sheet->getStyle("A2:E2")->getFont()->setBold(true);
	$sheet->getStyle("A2:E2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
	$sheet->setCellValue("A2", 'ФИО');
	$sheet->setCellValue("B2", 'Телефон');
	$sheet->setCellValue("C2", 'E-mail');
	$sheet->setCellValue("D2", 'Дата');
	$sheet->setCellValue("E2", 'Время');
	
	$sql->sql_connect();
	$result = $sql->sql_query("SELECT * FROM ".$sql->db_prefix."form ORDER BY id DESC");
	if($sql->sql_err){}
	else{
		if($sql->sql_rows($result)){
			$t = 3;
			while($query = $sql->sql_array($result)){
				$sheet->setCellValue("A".$t, $query["ifora_fio"]);
				$sheet->setCellValue("B".$t, $query["ifora_phone"]);
				$sheet->setCellValue("C".$t, $query["ifora_email"]);
				$sheet->setCellValue("D".$t, $query["ifora_date"]);
				$sheet->setCellValue("E".$t, $query["ifora_time"]);
				$t++;
			}
		}
	}
	$sql->sql_close();
	
	header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D,d M YH:i:s")." GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=file.xls");
	
	$objWriter = new PHPExcel_Writer_Excel5($xls);
	$objWriter->save('php://output');
?>