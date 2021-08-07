<?php
include("koneksi.php");

$selek = mysqli_query($konek,"SELECT * FROM proyek");
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();

$styleArray = array(
    'font'  => array(
        'size'  => 10
    ));

	$objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);

$styleArray = array(
	'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
    'font'  => array(
        'bold'  => true,
        'size'  => 11
    ));

$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($styleArray);
							
							
$row = 1;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$row, 'No')
            ->setCellValue('B'.$row, 'Nama Proyek')
            ->setCellValue('C'.$row, 'Nama Barang')
            ->setCellValue('D'.$row, 'Jumlah Barang')
            ->setCellValue('E'.$row, 'Supplier')
            ->setCellValue('F'.$row, 'Estimasi Pengerjaan')
			->setCellValue('G'.$row, 'Estimasi Biaya')
			->setCellValue('H'.$row, 'Mulai')
			->setCellValue('I'.$row, 'Jatuh Tempo')
			->setCellValue('J'.$row, 'Progress')
			->setCellValue('K'.$row, 'Status');

			$objPHPExcel->getSheet(0)->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getSheet(0)->getColumnDimension('B')->setWidth(36);
			$objPHPExcel->getSheet(0)->getColumnDimension('C')->setWidth(16);
			$objPHPExcel->getSheet(0)->getColumnDimension('D')->setWidth(16);
			$objPHPExcel->getSheet(0)->getColumnDimension('E')->setWidth(16);
			$objPHPExcel->getSheet(0)->getColumnDimension('F')->setWidth(19);
			$objPHPExcel->getSheet(0)->getColumnDimension('G')->setWidth(19);
			$objPHPExcel->getSheet(0)->getColumnDimension('H')->setWidth(12);
			$objPHPExcel->getSheet(0)->getColumnDimension('I')->setWidth(12);
			$objPHPExcel->getSheet(0)->getColumnDimension('J')->setWidth(11);
			$objPHPExcel->getSheet(0)->getColumnDimension('K')->setWidth(12);
			

$row++;
$no = 1;
while($data = mysqli_fetch_array($selek)){
	
	$progress = json_decode($data[9]);
	$jumlah = 0;
	foreach($progress as $atom){
		if($atom == "1") $jumlah++;
	}
	$persen = $jumlah/5*100;
	
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$row, $no )
            ->setCellValue('B'.$row, $data[1] )
            ->setCellValue('C'.$row, $data[2] )
            ->setCellValue('D'.$row, $data[3] )
            ->setCellValue('E'.$row, $data[4] )
			->setCellValue('F'.$row, $data[5] )
			->setCellValue('G'.$row, $data[6] )
			->setCellValue('H'.$row, $data[7] )
			->setCellValue('I'.$row, $data[8] )
			->setCellValue('J'.$row, $persen."%" )
			->setCellValue('K'.$row, $data[11] );
			
	$row++; 
	$no++;
}

$objPHPExcel->getActiveSheet()->getStyle('A2:L'.$objPHPExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 

$objWriter->save('php://output');
exit;

?>